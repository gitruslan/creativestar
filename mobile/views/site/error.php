<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

$this->title = $name;
$exception = Yii::$app->errorHandler->exception;
?>
<div class="error-page">
    <div class="error-code-blick-left"></div>
    <div class="error-code-blick-right"></div>
    <div class="error-page-stcode">
        <?php echo Html::encode($exception->statusCode) ?>
    </div>

    <div class="error-page-message">
        <?php echo nl2br(Html::encode($exception->getMessage())) ?>
    </div>

    <p class="error-page-explanation">
        The above error occurred while the Web server was processing your request.</br>
        Please contact us if you think this is a server error. Thank you.
    </p>
    <p>

    </p>
</div>
