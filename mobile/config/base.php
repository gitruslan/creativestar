<?php
return [
    'id' => 'mobile',
    'basePath'=>dirname(__DIR__),
    'components' => [
        'urlManager'=>require(__DIR__.'/_urlManager.php'),
        'request' => [
            'class' => 'mobile\components\LangRequest'
        ],
        'language'=>'ru-RU',
        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@frontend/messages',
                    'sourceLanguage' => 'en',
                    'fileMap' => [
                        //'main' => 'main.php',
                    ],
                ],
                'yii' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@frontend/messages',
                    'sourceLanguage' => 'en',
                    'fileMap' => [
                        'frontend' => 'frontend.php',
                    ],
                ],
            ],
        ],
    ],
];
