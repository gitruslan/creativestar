<?php
/* @var $this yii\web\View */
$this->title = Yii::$app->name;
?>
 <!--   --><?php /*echo \mobile\widgets\MobDbCarousel::widget([
        'key'=>'index'
    ]) */?>

    <div class="text-on-main">
        <?php echo common\widgets\DbText::widget([
            'key'=>'main-page-text'
        ]) ?>
    </div>


