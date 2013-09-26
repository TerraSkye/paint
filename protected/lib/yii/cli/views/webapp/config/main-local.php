<?php

return array(
    'modules' => array(
        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => '1375c0m4n2',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters' => array('127.0.0.1', '::1', '10.0.*'),
            'generatorPaths' => array(
                'common.generators',
            ),
        ),
    ),
    'components' => array(
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
        'class' => 'system.caching.CDummyCache',
    ),
    'log' => null
//		'log'=>array(
//            'class'=>'CLogRouter',
//            'routes'=>array(
//                array(
//                    'class'=>'CProfileLogRoute',
//                    'levels'=>'profile',
//                    'enabled'=>true,
//                ),
//            ),
//        ),
)
);
