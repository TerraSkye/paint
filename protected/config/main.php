<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'paint.com',
    'theme' => 'classic',
    // preloading 'log' component
    'language' => 'nl_NL',
    'sourceLanguage' => '00',
    'preload' => array('log', 'bootstrap', 'wizard'),
   'onBeginRequest' => array('ApplicationInitializer', 'publish'),
    'defaultController' => 'enquete/index',

    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.models.forms.*',
        'application.widgets.uniframe.*',
        'application.widgets.*',
        'application.components.*',
        'application.actions.*',
        'application.modules.contact.models.*',
        'application.modules.translateSource.models.*',
        'application.modules.contact.*',
        'application.modules.contact.controllers.*',
        'application.modules.user.models.*',
        'application.extensions.yii-mail.*',
        'application.modules.contact.registration.*',
        'application.widgets.bootstrap.*',
    ),

    'modules' => array(
        // uncomment the following to enable the Gii tool
        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => 'me',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters' => array('127.0.0.1', '::1'),
        ),
    ),

    // application components
    'components' => array(
        'request' => array(
            'enableCsrfValidation' => true,
            'enableCookieValidation' => true
        ),
        'wizard' => array(
            'class' => 'application.extensions.wizard.CWizardComponent'
        ),
        'mail' => array(
            'class' => 'application.extensions.yii-mail.YiiMail',
            'logging' => true,
            'dryRun' => false
        ),

        'bootstrap' => array(
            'class' => 'Bootstrap',
            'responsiveCss' => true,
        ),
        'assetManager' => array(
            'class' => 'AssetManager',
        ),
        'user' => array(
            // enable cookie-based authentication
            'allowAutoLogin' => true,
            'class' => 'WebUser',
            'userModelName' => 'Contact',
            'loginUrl' => array('/test/login')

        ), 'messages' => array(
            'class' => 'DbMessageSource',
            'cachingDuration' => 3600,
            'sourceMessageTable' => 'yii_source_message',
            'translatedMessageTable' => 'yii_message'
        ),
        'cache' => array(
            'class' => 'system.caching.CFileCache',
        ),

        'urlManager' => array(
            'urlFormat' => 'path',
            'showScriptName' => false,
            'rules' => array(


                '<Parentmodule>/<client_id:\d+>/<Childmodule>/<controller:\w+>/<action:\w+>/<id:\d+>'   =>
                '<Parentmodule>/<Childmodule>/<controller>/<action>',
                '<Parentmodule>/<client_id:\d+>/<Childmodule>/<controller:\w+>/<id:\d+>'                =>
                '<Parentmodule>/<Childmodule>/<controller>/view',
                '<Parentmodule>/<client_id:\d+>/<Childmodule>/<controller:\w+>/<action:\w+>'            =>
                '<Parentmodule>/<Childmodule>/<controller>/<action>',

                '<Parentmodule>/<client_id:\d+>/<Childmodule>/<controller:\w+>'                         =>
                '<Parentmodule>/<Childmodule>/<controller>/index',
                '<Parentmodule>/<client_id:\d+>/<Childmodule>/'                                         =>
                '<Parentmodule>/<Childmodule>/',

                '<module>/<controller:\w+>/<id:\d+>' => '<module>/<controller>/view',
                '<module>/<controller:\w+>/<action:\w+>/<id:\d+>' => '<module>/<controller>/<action>',
                '<module>/<controller:\w+>/<action:\w+>' => '<module>/<controller>/<action>',

                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',





            ),
        ),

        //todo gebruik deze voor real version
        'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=enquete',
            'emulatePrepare' => true,
            'enableProfiling' => true,
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ),
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
            ),
        ),
    ),

    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => require(dirname(__FILE__) . '/params.php'),
);