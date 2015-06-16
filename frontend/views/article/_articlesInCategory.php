<?php
/**
 * @var $this yii\web\View
 * @var $article common\articles\Article
 */
use yii\helpers\Html;

?>
<hr/>
<div class="article-item row">
    <div class="col-xs-12">
        <h2 class="article-title">
            <?php echo Html::a($article->title, $article->category->slug.'/'.$article->slug) ?>
        </h2>
        <div class="article-meta">
            <span class="article-date">
                <?php echo Yii::$app->formatter->asDatetime($article->created_at) ?>
            </span>,
            <span class="article-category">
                   <?=$article->category->title?>
            </span>
        </div>
        <div class="article-content">
            <?php if ($article->thumbnail_path): ?>
                <?php echo Html::img(
                    Yii::$app->glide->createSignedUrl([
                        'glide/index',
                        'path' => $article->thumbnail_path,
                        'w' => 100
                    ], true),
                    ['class' => 'article-thumb img-rounded pull-left']
                ) ?>
            <?php endif; ?>
            <div class="article-text">
                <?php echo \yii\helpers\StringHelper::truncate($article->body, 150)?>
            </div>
        </div>
    </div>
</div>