<?php

class CaptchaHandlerController extends BotDetectAppController {

    private $captcha;

    public function beforeFilter() {
        if ($this->isGetResourceContentsRequest()) {
            // validate filename
            $filename = $this->request->query['get'];
            if (!preg_match('/^[a-z-]+\.(css|gif|js)$/', $filename)) {
                $this->badRequest('Invalid file name.');
            }
        } else {
            // validate captcha id and load Captcha component
            $captchaId = $this->request->query['c'];
            if (!is_null($captchaId) && preg_match("/^(\w+)$/ui", $captchaId)) {
                $this->captcha = $this->Components->load('BotDetect.Captcha', array(
                    'captchaConfig' => $captchaId
                ));
            } else {
                $this->badRequest('Invalid captcha id.');
            }
        }

        parent::beforeFilter();

        if (method_exists('AuthComponent', 'allow')) {
            $this->Auth->allow('index');
        }
    }

    /**
     * Get the captcha image, sound, result validate, and file contents.
     */
    public function index() {

        if ($this->isGetResourceContentsRequest()) {
            // getting contents of css, js, and gif files.
            $this->getResourceContents();
        } else {
            // getting captcha image, sound, validation result
            $commandString = $this->request->query['get'];
            if (!BDC_StringHelper::HasValue($commandString)) {
                BDC_HttpHelper::BadRequest('command');
            }

            $command = BDC_CaptchaHttpCommand::FromQuerystring($commandString);
            switch ($command) {
                case BDC_CaptchaHttpCommand::GetImage:
                    $responseBody = $this->getImage();
                    break;
                case BDC_CaptchaHttpCommand::GetSound:
                    $responseBody = $this->getSound();
                    break;
                case BDC_CaptchaHttpCommand::GetValidationResult:
                    $responseBody = $this->getValidationResult();
                    break;
                default:
                    BDC_HttpHelper::BadRequest('command');
                    break;
            }

            // disallow audio file search engine indexing
            header('X-Robots-Tag: noindex, nofollow, noarchive, nosnippet');

            $this->autoRender = false;
            $this->response->disableCache();
            $this->response->body($responseBody);
        }
    }

    public function getResourceContents() {
        $filename = $this->request->query['get'];

        $this->viewClass = 'Media';

        $fileInfo  = pathinfo($filename);
        if (!(is_array($fileInfo) && array_key_exists('filename', $fileInfo) && array_key_exists('extension', $fileInfo))) {
            $this->badRequest(sprintf('The "%s" file could not be found.', $filename));
        }

        $params = array(
            'id'        => $filename,
            'name'      => $fileInfo['filename'],
            'download'  => false,
            'extension' => $fileInfo['extension']
        );
        
        $resourcePath = $this->getResourcePath();
        if (!is_null($resourcePath)) {
             $params['path'] = $resourcePath;
             $this->set($params);
        }
    }

    private function getResourcePath() {
        $innerAppDirResource = APP . 'Lib' . DS . 'botdetect' . DS .'public/';
        if (is_dir($innerAppDirResource)) {
            return $innerAppDirResource;
        }

        $outerResource = ROOT . '/../lib/botdetect/public/';
        if (is_dir($outerResource)) {
            return $outerResource;
        }

        $innerRootDirResource = ROOT . '/lib' . DS . 'botdetect' . DS . 'public/';
        if (is_dir($innerRootDirResource)) {
            return $innerRootDirResource;
        }

        return null;
    }

    /**
     * Get captcha image.
     *
     * @return image
     */
    public function getImage() {

        if (is_null($this->captcha)) {
            BDC_HttpHelper::BadRequest('captcha');
        }

        // identifier of the particular Captcha object instance
        $instanceId = $this->getInstanceId();
        if (is_null($instanceId)) {
            BDC_HttpHelper::BadRequest('instance');
        }

        // response headers
        BDC_HttpHelper::DisallowCache();

        // response MIME type & headers
        $mimeType = $this->captcha->CaptchaBase->ImageMimeType;
        $this->response->type($mimeType);

        // we don't support content chunking, since image files
        // are regenerated randomly on each request
        header('Accept-Ranges: none');

        // image generation
        $rawImage = $this->captcha->CaptchaBase->GetImage($instanceId);
        $this->captcha->CaptchaBase->SaveCodeCollection(); // record generated Captcha code for validation

        // output image bytes
        $length = strlen($rawImage);
        header("Content-Length: {$length}");
        return $rawImage;
    }

    /**
     * Get captcha sound.
     *
     * @return sound
     */
    public function getSound() {

        if (is_null($this->captcha)) {
            BDC_HttpHelper::BadRequest('captcha');
        }

        // identifier of the particular Captcha object instance
        $instanceId = $this->getInstanceId();
        if (is_null($instanceId)) {
            BDC_HttpHelper::BadRequest('instance');
        }

        // response headers
        BDC_HttpHelper::SmartDisallowCache();

        // response MIME type & headers
        $mimeType = $this->captcha->CaptchaBase->SoundMimeType;
        $this->response->type($mimeType);
        header('Content-Transfer-Encoding: binary');

        // sound generation
        $rawSound = $this->captcha->CaptchaBase->GetSound($instanceId);
        return $rawSound;
    }

    /**
     * The client requests the Captcha validation result (used for Ajax Captcha validation).
     *
     * @return json
     */
    public function getValidationResult() {

        if (is_null($this->captcha)) {
            BDC_HttpHelper::BadRequest('captcha');
        }

        // identifier of the particular Captcha object instance
        $instanceId = $this->getInstanceId();
        if (is_null($instanceId)) {
            BDC_HttpHelper::BadRequest('instance');
        }

        $mimeType = 'application/json';
        $this->response->type($mimeType);
        
        // code to validate
        $userInput = $this->getUserInput();

        // JSON-encoded validation result
        $result = $this->captcha->AjaxValidate($userInput, $instanceId);
        $this->captcha->CaptchaBase->SaveCodeCollection();

        $resultJson = $this->getJsonValidationResult($result);

        return $resultJson;
    }

    /**
     * @return string
     */
    private function getInstanceId() {
        $instanceId = $this->request->query['t'];
        if (!BDC_StringHelper::HasValue($instanceId) ||
            !BDC_CaptchaBase::IsValidInstanceId($instanceId)) {
            return;
        }
        return $instanceId;
    }

    /**
     * Extract the user input Captcha code string from the Ajax validation request.
     *
     * @return string
     */
    private function getUserInput() {
        $input = null;

        if (isset($this->request->query['i'])) {
            // BotDetect built-in Ajax Captcha validation
            $input = $this->request->query['i'];
        } else {
            // jQuery validation support, the input key may be just about anything,
            // so we have to loop through fields and take the first unrecognized one
            $recognized = array('get', 'c', 't', 'd');
            foreach($this->request->query as $key => $value) {
                if (!in_array($key, $recognized)) {
                    $input = $value;
                    break;
                }
            }
        }

        return $input;
    }

    /**
     * Encodes the Captcha validation result in a simple JSON wrapper.
     *
     * @return string
     */
    private function getJsonValidationResult($result) {
        $resultStr = ($result ? 'true': 'false');
        return $resultStr;
    }

    /**
     * @return bool
     */
    private function isGetResourceContentsRequest() {
        $http_get_data = $this->request->query;
        return array_key_exists('get', $http_get_data) && !array_key_exists('c', $http_get_data);
    }

    /**
     * Throw an error header.
     *
     * @param string  $message
     * @return void
     */
    private function badRequest($message) {
        while (ob_get_contents()) { ob_end_clean(); }
        header('HTTP/1.1 400 Bad Request');
        header('Content-Type: text/plain');
        echo $message;
        exit;
    }
}
