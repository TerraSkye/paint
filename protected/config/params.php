<?php
return array(
    'siteType' => 'enquete',
    'label' => 'website',
    'configurations' => array(
        'uniframe' => array(
            'options' => array(
                'headerLink' => '#',
            )
        ),
        'assets' => array(
            'css' => array(
                'application.assets.css' => array(
                    'normalize.min.css',
                    'framework.css',
                    'main.css',
                    'layout.css',
                    'prettyPhoto.css',
                ),
            ),
            'js' => array(
                'application.assets.js' => array(
                    'jquery.hover-intent.js',
                    'jquery.drag.js',
                    'jquery.prettyPhoto.js',
                )
            )
        ),
    )

);