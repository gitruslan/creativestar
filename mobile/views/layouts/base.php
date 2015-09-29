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

    $this->beginContent('@mobile/views/layouts/_clear.php')
?>

    <div class="wrap">
        <div class="navbar-wrapper">
            <div class="navbar-shadow">
                <div class="navbar-center-logo"></div>
                <div class="navbar-left-menu">
                </div>
            </div>
        </div>
        <div class="content-wrapper">
            <?php echo $content ?>
        </div>
    </div>
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-menu">
                <div class="footer-menu-line"></div>
                    <ul><li><a href="/" class="">Home</a></li>
                        <li><a href="/games">Games</a></li>
                        <li><a href="/about-us">About us</a></li>
                        <li><a href="/blog">Blog</a></li>
                        <li><a href="/site/contact">Contact</a></li>
                    </ul>
            </div>
            <div class="footer-owners">
                <div class="copy">&copy; Creativistar <?php echo date('Y') ?></div>
                <div class="reserved">ALL rights reserved</div>
            </div>
        </div>
    </footer>

<?php $this->endContent() ?>