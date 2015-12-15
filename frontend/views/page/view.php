<?php
/**
 * @var $this \yii\web\View
 * @var $model \common\models\Page
 */
$this->title = $model->title;
Yii::$app->params['description'] = $model->description;
Yii::$app->params['keywords'] = $model->keywords;
?>
<div class="content">
    <h1><?php echo $model->title ?></h1>
    <?php echo $model->body ?>
</div>