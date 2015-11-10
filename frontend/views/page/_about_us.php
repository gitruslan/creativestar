<?php
/**
 * Created by PhpStorm.
 * User: ruslan
 * Date: 8/2/15
 * Time: 8:13 PM
 * @var $this \yii\web\View
 * @var $model \common\models\Page
 */
Yii::$app->params['description'] = $model->description;
Yii::$app->params['keywords'] = $model->keywords;
$this->title = $model->title;
?>
<div class="aboutus-right-img"></div>
<div class="aboutus-left-img"></div>
<div class="aboutus-blick-img"></div>
<div class="about-us-wrapper">
    <?php echo $model->body ?>
</div>