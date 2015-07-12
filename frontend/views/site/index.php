<?php
/* @var $this yii\web\View */
$this->title = Yii::$app->name;
?>
<div class="site-index">


   <div class="carousel-wrapper">
       <div class="carousel-left-top-image"></div>
       <div class="carousel-left-bottom-image"></div>
       <div class="carousel-right-top-image"></div>
       <div class="carousel-right-bottom-image"></div>
    <?php echo \common\widgets\DbCarousel::widget([
        'key'=>'index'
    ]) ?>
   </div>

    <div class="text-on-main">
        <?php echo common\widgets\DbText::widget([
            'key'=>'main-page-text'
        ]) ?>

    </div>


