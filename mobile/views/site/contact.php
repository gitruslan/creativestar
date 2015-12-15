<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model \mobile\models\ContactForm */

$this->title = 'Contacts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <div class="form-contact">
        <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
            <?php echo $form->field($model, 'name')->textInput(['placeholder' => Yii::t('mobile', 'Your name')])  ?>
            <?php echo $form->field($model, 'email')->textInput(['placeholder' => Yii::t('mobile', 'your@email')])  ?>
            <?php echo $form->field($model, 'subject')->textInput(['placeholder' => Yii::t('mobile', 'Subject')])  ?>
            <?php echo $form->field($model, 'body')->textArea(['rows' => 7,'placeholder' =>Yii::t('mobile', 'Message')])  ?>
            <?php echo Html::submitButton(Yii::t('frontend', ''), ['class' => 'contact-button', 'name' => 'contact-button']) ?>
        <?php ActiveForm::end(); ?>
    </div>
    <hr class="contacts-line">
</div>
<?php echo common\widgets\DbText::widget([
    'key'=>'social-buttons'
]) ?>
