<?php
/**
 * @var $this yii\web\View
 * @var $article common\articles\Article
 */
use yii\helpers\Html;

?>
<div class="article-item">
        <h2 class="article-title-games">
            <?php echo Html::a($article->title,$article->category->slug.'/'.$article->slug) ?>
        </h2>
        <?php if ($article->thumbnail_path): ?>
            <?php echo Html::img(
                Yii::$app->glide->createSignedUrl([
                    'glide/index',
                    'path' => $article->thumbnail_path,
                    'w' => 320,
                    'h' => 200
                ], true),
                ['class' => 'article-thumb']
            ) ?>
        <?php endif; ?>
        <div class="article-short-text">
            <?php echo \yii\helpers\StringHelper::truncate($article->body, 150)?>
        </div>
</div>