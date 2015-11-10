<?php
    /* @var $this yii\web\View */
    $this->title = $category->title;
    Yii::$app->params['description'] = $category->description;
    Yii::$app->params['keywords'] = $category->keywords;
    $this->params['breadcrumbs'][] = $category->title;
?>
<div id="article-index">
    <?php echo \backend\widgets\ListArticles::widget([
        'articles'=> $category->articles,
        'articleView'=>'_articles_in_category'
    ])?>
</div>
