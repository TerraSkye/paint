<?php

return array(
    'components' => array(
        'cache' => array(
            'class' => 'system.caching.CDummyCache',
        ),
        'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=enquete.nl',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ),
    )


);
