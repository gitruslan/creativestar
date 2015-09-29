<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model \frontend\models\ContactForm */

$this->title = 'Contacts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <div class="row">
        <div class="form-contact">
            <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
                <?php echo $form->field($model, 'name') ?>
                <?php echo $form->field($model, 'email') ?>
                <?php echo $form->field($model, 'subject') ?>
                <?php echo $form->field($model, 'body')->textArea(['rows' => 7]) ?>
                <?php echo Html::submitButton(Yii::t('frontend', ''), ['class' => 'contact-button', 'name' => 'contact-button']) ?>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
<?php echo common\widgets\DbText::widget([
    'key'=>'social-buttons'
]) ?>
