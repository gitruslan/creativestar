<?php
/**
 * Created by PhpStorm.
 * User: ruslan
 * Date: 8/7/15
 * Time: 10:51 PM
 */
namespace frontend\widgets;

use Yii;
use \yii\base\Widget;
use \yii\helpers\Html;
use \yii\helpers\ArrayHelper;
use \common\models\ArticleCategory;


class DropDownArticleList extends Widget{
    /**
     * @var string
     */
    public $name = 'Drop Down list';
    /**
     * @var string
     */
    public $category = 'games';
    /**
     * @var string
     */
    public $slug = '';
    /**
     * @var string
     */
    public $class = 'dropdown-list';

    public $renderFile = 'drop-down-list';

    public function run(){
        $cacheKey = [
            ArticleCategory::className(),
            $this->name
        ];
        if (!$dropDownList = Yii::$app->cache->get($cacheKey)) {
            if ($articles = ArticleCategory::find()->active($this->category)->one()) {
                $dropDownList = $this->renderFile($this->_renderFile(),[
                    'articles'=> $articles->articles,
                    'category'=> $this->category,
                    'class'   => $this->class,
                    'name'    => $this->name
                ]);
            }
        }
        return $dropDownList;
    }

    /**
     * Build view path
     */
    private function _renderFile(){
        return $this->getViewPath()."/".$this->renderFile.".php";
    }

}


