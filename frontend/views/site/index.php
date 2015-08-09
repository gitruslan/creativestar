<?php
/* @var $this yii\web\View */
$this->title = Yii::$app->name;
?>
    <?php echo \common\widgets\DbCarousel::widget([
        'key'=>'index'
    ]) ?>

    <div class="text-on-main">
        <?php echo common\widgets\DbText::widget([
            'key'=>'main-page-text'
        ]) ?>

    </div>


