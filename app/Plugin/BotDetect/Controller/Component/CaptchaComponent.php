<?php

if (!defined('BDCAKE_PLUGIN_PATH')) { define('BDCAKE_PLUGIN_PATH', dirname(dirname(__DIR__)) . DS); }

require_once(BDCAKE_PLUGIN_PATH . 'Support/helpers.php');
require_once(BDCAKE_PLUGIN_PATH . 'Support/LibraryLoader.php');
require_once(BDCAKE_PLUGIN_PATH . 'Support/UserCaptchaConfiguration.php');

class CaptchaComponent extends Component {

    /**
     * @var object
     */
    private $captcha;

    /**
     * BotDetect CakePHP CAPTCHA plugin information.
     *
     * @var array
     */
    public static $productInfo;

    /**
     * @var object
     */
    private static $instance;

    /**
     * Create a new Captcha Component object.
     *
     * @return void
     */
    public function __construct(ComponentCollection $collection, $params = array()) {
        self::$instance =& $this;

        // load botdetect captcha library
        BDCAKE_LibraryLoader::load();

        // change the keys in $param array to lowercase,
        // this will avoid user being able to pass in a lowercase option (e.g. captchaconfig)
        $params = array_change_key_case($params, CASE_LOWER);

        if (empty($params) ||
            !array_key_exists('captchaconfig', $params) ||
            empty($params['captchaconfig'])
        ) {
            $errorMessage  = 'The BotDetect Captcha component requires you to declare "captchaConfig" option and assigns a captcha configuration key defined in config/captcha.php file.<br>';
            $errorMessage .= 'For example: public $components = array(\'BotDetect.Captcha\' => array(\'captchaConfig\' => \'ContactCaptcha\'));';
            throw new InvalidArgumentException($errorMessage);
        }

        $captchaId = $params['captchaconfig'];

        // get captcha config
        $config = BDCAKE_UserCaptchaConfiguration::get($captchaId);

        if (null === $config) {
            throw new InvalidArgumentException(sprintf('The "%s" option could not be found in config/captcha.php file.', $captchaId));
        }

        if (!is_array($config)) {
            throw new InvalidArgumentException($config, 'array');
        }

        // save user's captcha configuration options
        BDCAKE_UserCaptchaConfiguration::save($config);
        
        // init botdetect captcha instance
        $this->initCaptcha($config);
    }

    /**
     * Initialize CAPTCHA instance.
     *
     * @param  array  $config
     * @return void
     */
    public function initCaptcha($config = array()) {
        // set captchaId and create an instance of the Captcha
        $captchaId = (array_key_exists('CaptchaId', $config)) ? $config['CaptchaId'] : 'defaultCaptchaId';
        $this->captcha = new Captcha($captchaId);
        
        // set user's input id
        $userInputID = $config['UserInputID'];
        if ($userInputID) {
            $this->captcha->UserInputID = $userInputID;
        }
    }

    /**
     * Get Captcha Component object instance.
     *
     * @return object
     */
    public static function &getInstance() {
        return self::$instance;
    }

    public function __call($method, $args = array()) {
        if (method_exists($this, $method)) {
            return call_user_func_array(array($this, $method), $args);
        }

        if (method_exists($this->captcha, $method)) {
            return call_user_func_array(array($this->captcha, $method), $args);
        }
    }

    /**
     * Auto-magic helpers for civilized property access.
     */
    public function __get($name) {
        if (method_exists($this->captcha, ($method = 'get_'.$name))) {
            return $this->captcha->$method();
        }

        if (method_exists($this, ($method = 'get_'.$name))) {
            return $this->$method();
        }
    }

    public function __isset($name) {
        if (method_exists($this->captcha, ($method = 'isset_'.$name))) {
            return $this->captcha->$method();
        } 

        if (method_exists($this, ($method = 'isset_'.$name))) {
            return $this->$method();
        }
    }

    public function __set($name, $value) {
        if (method_exists($this->captcha, ($method = 'set_'.$name))) {
            $this->captcha->$method($value);
        } else if (method_exists($this, ($method = 'set_'.$name))) {
            $this->$method($value);
        }
    }

    public function __unset($name) {
        if (method_exists($this->captcha, ($method = 'unset_'.$name))) {
            $this->captcha->$method();
        } else if (method_exists($this, ($method = 'unset_'.$name))) {
            $this->$method();
        }
    }
    
    /**
     * Get the BotDetect CakePHP CAPTCHA plugin information.
     *
     * @return array
     */
    public static function getProductInfo() {
        return self::$productInfo;
    }
}


// static field initialization
CaptchaComponent::$productInfo = array(
    'name' => 'BotDetect 4 PHP Captcha generator integration for the CakePHP framework', 
    'version' => '4.1.0'
);
