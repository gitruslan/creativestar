<?php
/**
 * Created by PhpStorm.
 * User: ruslan
 * Date: 6/29/15
 * Time: 8:39 PM
 */


use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use common\widgets\DbMenu;

/* @var $this \yii\web\View */
/* @var $content string */

    $this->beginContent('@frontend/views/layouts/_clear.php')
?>

    <div class="wrap">
        <div class="navbar-wrapper">
            <div class="navbar-shadow">
                <div class="navbar-center-logo"></div>
                <div class="navbar-menu-blick"></div>
                <div class="navbar-center-menu">
                    <?=DBMenu::widget([
                        'key'=>'frontend-main-menu',
                        'options'=>[
                            'tag'=>'ul'
                        ]
                    ]);?>
                </div>
            </div>
        </div>
        <div class="content-wrapper">
            <?php echo $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p class="pull-left">&copy; Creativestar <?php echo date('Y') ?></p>
            <p class="pull-right"><?php echo Yii::powered() ?></p>
        </div>
    </footer>
<?php $this->endContent() ?>