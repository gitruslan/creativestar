<?php
    use \frontend\widgets\DropDownArticleList;
    use common\widgets\DbArticleSlider;

    /* @var $this yii\web\View */
    /* @var $model common\models\Article */
    /* @var $articles common\models\Article */
    $this->title = $model->title;
    $this->registerMetaTag([
        'name'=>'description',
        'content'=>$model->description
    ]);
    $this->registerMetaTag([
        'name'=>'keywords',
        'content'=>$model->keywords
    ]);
    $this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', $model->category->title), 'url' => '/'.$model->category->slug];
    $this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-content">
    <?= DropDownArticleList::widget([
        'category' => $model->category->slug,
        'name'=>'Choose article',
    ]); ?>
    <div class="clear"></div>
    <div class="article-item-title-game">
        <div class="game-title"><?php echo $model->title ?></div>
    </div>
    <div class="article-item-image-blog">
        <?php if ($model->thumbnail_path): ?>
            <?php echo \yii\helpers\Html::img(
                Yii::$app->glide->createSignedUrl([
                    'glide/index',
                    'path' => $model->thumbnail_path,
                    'w' => 320,
                    'h' => 200
                ], true),
                ['class' => '']
            ) ?>
        <?php endif; ?>
    </div>
    <div class="article-item-body-game">
        <?php echo $model->body ?>
    </div>
</div>