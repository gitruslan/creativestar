<?php
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
<div class="content">
    <div class="article-item-game">ss
        <div class="article-item-title-game">
            <div class="game-title"><?php echo $model->title ?></div>
        </div>
        <div class="article-item-image-game">
            <?php if ($model->thumbnail_path): ?>
                <?php echo \yii\helpers\Html::img(
                    Yii::$app->glide->createSignedUrl([
                        'glide/index',
                        'path' => $model->thumbnail_path,
                        'w' => 733,
                        'h' => 435
                    ], true),
                    ['class' => 'img-rounded']
                ) ?>
            <?php endif; ?>
        </div>
        <div class="games-underline"></div>
        <div class="article-item-body-game">
            <?php echo $model->body ?>
        </div>

        <?php if (!empty($model->articleAttachments)): ?>
            <h3><?php echo Yii::t('frontend', 'Attachments') ?></h3>
            <ul id="article-attachments">
                <?php foreach ($model->articleAttachments as $attachment): ?>
                    <li>
                        <?php echo \yii\helpers\Html::a(
                            $attachment->name,
                            ['attachment-download', 'id' => $attachment->id])
                        ?>
                        (<?php echo Yii::$app->formatter->asSize($attachment->size) ?>)
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

    </div>
</div>