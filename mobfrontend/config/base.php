<?php
return [
    'id' => 'frontend',
    'basePath'=>dirname(__DIR__),
    'components' => [
        'urlManager'=>require(__DIR__.'/_urlManager.php'),
        'request' => [
            'class' => 'frontend\components\LangRequest'
        ],
        'language'=>'ru-RU',
//        'i18n' => [
//            'translations' => [
//                '*' => [
//                    'class' => 'yii\i18n\PhpMessageSource',
//                    'basePath' => '@frontend/messages',
//                    'sourceLanguage' => 'en',
//                    'fileMap' => [
//                        //'main' => 'main.php',
//                    ],
//                ],
//            ],
//        ],
    ],
];
