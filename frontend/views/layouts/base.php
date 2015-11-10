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
use \common\models\Lang;

/* @var $this \yii\web\View */
/* @var $content string */
$this->registerMetaTag([
    'name'=>'description',
    'content'=>Yii::$app->params['description']
]);
$this->registerMetaTag([
    'name'=>'keywords',
    'content'=>Yii::$app->params['keywords']
]);


$this->beginContent('@frontend/views/layouts/_clear.php')
?>

    <div class="wrap">
        <div class="navbar-wrapper">
            <div class="navbar-shadow">
                <div class="navbar-center-logo"></div>
                <div class="navbar-menu-blick"></div>
                <div class="navbar-menu-slogan">
                        <?php echo common\widgets\DbText::widget([
                            'key'=>'slogan'
                        ]) ?>
                </div>
                <div class="navbar-center-menu">
                    <?=DBMenu::widget([
                        'key'=>'frontend-main-menu',
                        'activeCssClass'=>'active-menu-item',
                        'options'=>[
                            'tag'=>'ul',
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
        <div class="footer-container">
            <div class="footer-star"></div>
            <div class="footer-menu">
                <div class="footer-menu-line"></div>
                    <ul><li><a href="/" class="">Home</a></li>
                        <li><a href="/<?=Lang::getCurrent()->url?>/games">Games</a></li>
                        <li><a href="/<?=Lang::getCurrent()->url?>/about-us">About us</a></li>
                        <li><a href="/<?=Lang::getCurrent()->url?>/blog">Blog</a></li>
                        <li><a href="/<?=Lang::getCurrent()->url?>/site/contact">Contact</a></li>
                    </ul>
            </div>
            <div class="footer-owners">
                <div class="copy">&copy; Creativistar <?php echo date('Y') ?></div>
                <div class="reserved">ALL rights reserved</div>
                <div class="terms-privacy">
                    <a href="/<?=Lang::getCurrent()->url?>/terms-of-use">Terms of use</a> and
                    <a href="/<?=Lang::getCurrent()->url?>/privacy-policy">Privacy Policy</a>
                </div>
            </div>
        </div>
    </footer>

<?php $this->endContent() ?>