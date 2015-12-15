<?php
/**
 * Created by PhpStorm.
 * User: ruslan
 * Date: 10/13/15
 * Time: 11:26 PM
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
<div class="privacy-terms-wrapper">
    <div class="body-text">
     <?php echo $model->body ?>
    </div>
</div>