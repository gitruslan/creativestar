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
            <div class="navbar-center-logo"><?=Yii::$app->name;?></div>
            <div class="navbar-center-menu">
                <?=DBMenu::widget([
                    'key'=>'frontend-main-menu',
                    'options'=>[
                        'tag'=>'ul'
                    ]
                ]);?>
            </div>
        </div>

<!--        <ul>-->
<!--            <li><a href="/">--><?//=Yii::t('frontend', 'Home');?><!--</a></li>-->
<!--            <li><a href="/games">--><?//=Yii::t('frontend', 'Games');?><!--</a></li>-->
<!--            <li><a href="/about">--><?//=Yii::t('frontend', 'About us');?><!--</a></li>-->
<!--            <li><a href="/blog">--><?//=Yii::t('frontend', 'Blog');?><!--</a></li>-->
<!--            <li><a href="/site/contact">--><?//=Yii::t('frontend', 'Contacts');?><!--</a></li>-->
<!--        </ul>-->

        <?php echo $content ?>

    </div>

    <footer class="footer">
        <div class="container">
            <p class="pull-left">&copy; Creativestar <?php echo date('Y') ?></p>
            <p class="pull-right"><?php echo Yii::powered() ?></p>
        </div>
    </footer>
<?php $this->endContent() ?>