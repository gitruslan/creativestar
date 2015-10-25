<?php
/**
 * Created by PhpStorm.
 * User: ruslan
 * Date: 8/2/15
 * Time: 8:13 PM
 * @var $this \yii\web\View
 * @var $model \common\models\Page
 */
$this->title = $model->title;
$this->registerMetaTag([
    'name'=>'description',
    'content'=>$model->description
]);
$this->registerMetaTag([
    'name'=>'keywords',
    'content'=>$model->keywords
]);
$this->title = $model->title;
?>
<div class="about-us-wrapper">
    <?php echo $model->body ?>
</div>