<?php
    use \frontend\widgets\DropDownArticleList;
    use \yii\helpers\Html;
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
       'name'=>'Choose game',
   ]); ?>
    <?php
        if($model->articleAttributes){
            echo Html::a('',$model->articleAttributes->value,['class'=>$model->articleAttributes->name]);
        }
    ?>
    <div class="clear"></div>
        <div class="article-item-title-game">
            <div class="game-title"><?php echo $model->title ?></div>
        </div>
        <?php if(!empty($model->articleSlider)):?>
            <?php echo DbArticleSlider::widget(
                [
                    'article_id'=>$model->id,
                    'key'=>$model->id,
                ]
            )?>
        <?php endif;?>
        <div class="article-item-body-game">
            <?php echo $model->body ?>
        </div>
</div>
