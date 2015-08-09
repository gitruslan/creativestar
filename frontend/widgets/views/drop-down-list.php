<?php
/**
 * Created by PhpStorm.
 * User: ruslan
 * Date: 8/8/15
 * Time: 12:12 AM
 */
    /* @var $articles common\models\Article */
    /* @var $class string */
    /* @var $category string */
    /* @var $name string widget name */
?>
<div class="<?=$class?>">
    <div class="dropdown-wrapper">
        <div class="main-item">
            <div class="title"><?=$name;?></div>
            <div class="caret-item"></div>
        </div>
        <div class="center-item">
           <?php foreach ($articles as $article) :?>
            <div class="items" data-value="/<?=$category?>/<?=$article->slug?>"><?=$article->title?></div>
           <?php endforeach;?>
        </div>
       <div class="bottom-item"></div>
   </div>
</div>
