<?php

Router::connect('/captcha-handler', array('plugin' => 'BotDetect', 'controller' => 'CaptchaHandler', 'action' => 'index'));
