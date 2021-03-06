<?php
/**
 * @var $this yii\web\View
 * @var $article common\articles\Article
 */
use yii\helpers\Html;

?>
<div class="article-item row">
    <div class="col-xs-12">
        <h2 class="article-title-games">
            <?=$article->title;?>
        </h2>
        <?php if ($article->thumbnail_path): ?>
            <?php echo Html::a(Html::img(
                Yii::$app->glide->createSignedUrl([
                    'glide/index',
                    'path' => $article->thumbnail_path,
                    'w' => 296,
                    'h' => 186
                ], true),
                ['class' => 'article-thumb img-rounded pull-left']
            ),$article->category->slug.'/'.$article->slug); ?>
        <?php endif; ?>
        <div class="article-content">
            <?php if ($article->category->slug == 'blog'):?>
                <div class="article-date"><?=date('d M Y',$article->published_at)?></div>
            <?php endif;?>
            <div class="article-right-text">
                <?php echo \yii\helpers\StringHelper::truncate(strip_tags($article->body,'br'), 150)?>
            </div>
            <div class="article-more">
                <?php echo Html::a(Yii::t('frontend', 'MORE'),$article->category->slug.'/'.$article->slug) ?>
            </div>
        </div>
        <div class="article-underline"></div>
    </div>
</div>