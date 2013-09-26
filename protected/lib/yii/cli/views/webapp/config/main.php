<?php
return CMap::mergeArray(
    require(dirname(__FILE__).'/../../../common/config/web.php'),
	array(
		'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
		'name'=>'websitename',
        'theme'=>'default',
		// application components
		'components'=>array(
			'user'=>array(
				// enable cookie-based authentication
				'allowAutoLogin'=>true,
			),
            'db' => array(
                'connectionString' => 'mysql:host=localhost;dbname=heit2',
                'emulatePrepare' => true,
                'username' => 'root',
                'password' => '',
                'charset' => 'utf8',
                'enableProfiling' => true,
                'enableParamLogging' => true,
            ),
			'cache' => array(
				'class' => 'system.caching.CFileCache',
			),
            'themeManager'=>array(
                'basePath'=>realpath(dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'themes')
            ),
			'urlManager' => array(
//				'baseUrl' => 'http://www.studentoftheyear.nl',
				'class' => 'common.components.TranslationUrlManager',
				'urlFormat' => 'path',
				'showScriptName' => false,
				'rules' => array(
					// default url shizzle
					array(
						'class' => 'common.components.TranslateUrlRule',
						'connectionID' => 'db',
					),
					array(
						'class' => 'common.components.TransformUrlRule',
						'type' => 'lowerCamelCase',
						'delimiter' => '-'
					),
				),
			),
		),
		
		'defaultController' => 'site/index',
		// application-level parameters that can be accessed
		// using Yii::app()->params['paramName']
		'params'=>require(dirname(__FILE__).'/params-local.php'),
        'modules'=>array(

        ),
	)
);
