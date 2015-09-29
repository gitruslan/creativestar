<?php
    /* @var $this yii\web\View */
    $this->title = $category->title."::";
    $this->registerMetaTag([
        'name'=>'description',
        'content'=>$category->description
    ]);
    $this->registerMetaTag([
        'name'=>'keywords',
        'content'=>$category->keywords
    ]);
    $this->params['breadcrumbs'][] = $category->title;
?>
<div id="article-index">
    <?php echo \backend\widgets\ListArticles::widget([
        'articles'=> $category->articles,
        'articleView'=>'_articles_in_category'
    ])?>
</div>
