<?php
/**
 * Created by PhpStorm.
 * User: ruslan
 * Date: 11/17/15
 * Time: 8:49 PM
 */

namespace backend\widgets;

use yii\widgets\InputWidget;
use yii\helpers\Html;

/**
 * Class ArticleAttribute
 * @package backend\widgets
 */
class ArticleAttributes extends InputWidget
{

    public function init(){
        parent::init();
    }

    public function run(){
        //exit(Html::getInputId($this->model, $this->attribute));
        echo Html::beginTag('div', ['style' => 'position: relative']);
        if ($this->hasModel()) {
            echo Html::activeTextInput($this->model, $this->attribute, $this->options);
        } else {
            echo Html::textInput($this->name, $this->value, $this->options);
        }
        echo Html::endTag('div');
    }

}