<?php
/**
 * Created by PhpStorm.
 * User: ruslan
 * Date: 11/17/15
 * Time: 8:49 PM
 */

namespace backend\widgets;

use yii\helpers\ArrayHelper;
use yii\widgets\InputWidget;
use yii\helpers\Html;

/**
 * Class ArticleAttribute
 * @package backend\widgets
 */
class ArticleAttributes extends InputWidget
{
    /**
     * @var
     */
    public $tag;

    public function init(){
        parent::init();
        if ($this->hasModel()) {
            //exit(var_dump($this->model->getArticleAttributes()));
            $this->value = $this->value ?: Html::getAttributeValue($this->model, $this->attribute);
        }
        ArrayHelper::merge($this->options,[
            $this->value,
            $this->tag
        ]);
    }

    public function run(){
        echo Html::beginTag('div', ['style' => 'position: relative']);
        if ($this->hasModel()) {
            echo Html::activeTextInput($this->model, $this->attribute, $this->options);
        } else {
            echo Html::textInput("test", "value12", $this->options);
        }
        echo Html::endTag('div');
    }

}