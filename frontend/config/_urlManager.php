<?php
return [
    'class'=>'yii\web\UrlManager',
    'enablePrettyUrl'=>true,
    'showScriptName'=>false,
    'class'=>'frontend\components\LangUrlManager',
    'rules'=> [
        // Pages
        //['pattern'=>'page/<slug>', 'route'=>'page/view'],
        ['pattern'=>'<slug:(about-us)>','route'=>'page/view'],
        ['pattern'=>'<slug:(terms-of-use)>','route'=>'page/view'],
        ['pattern'=>'<slug:(privacy-policy)>','route'=>'page/view'],

        // Articles
        ['pattern'=>'article/index', 'route'=>'article/index'],
        ['pattern'=>'article/attachment-download', 'route'=>'article/attachment-download'],
        ['pattern'=>'<category:(news|blog|games)>', 'route'=>'article/articles-category-view'],
        ['pattern'=>'<category:(news|blog|games)>/<slug>', 'route'=>'article/view'],

        // Api
        ['class' => 'yii\rest\UrlRule', 'controller' => 'api/v1/article', 'only' => ['index', 'view', 'options']],
        ['class' => 'yii\rest\UrlRule', 'controller' => 'api/v1/user', 'only' => ['index', 'view', 'options']]
    ]
];
