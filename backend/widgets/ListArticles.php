<?php
/**
 * Created by PhpStorm.
 * User: labuta
 * Date: 6/16/15
 * Time: 6:08 PM
 */
namespace backend\widgets;

use Yii;
use yii\base\Widget;

class ListArticles extends Widget{
    /**
     * @var array
     */
    public $articles = [];
    public $articleView = '_item';


    /**
     * Init render widget
     */
    public function init(){
        foreach($this->articles as $art){
           echo $this->getView()->render($this->articleView,[
                'article'=>$art
            ]);
        }
    }
}