<?php
/**
 * Created by PhpStorm.
 * User: ruslan
 * Date: 11/14/15
 * Time: 12:18 PM
 */
namespace common\behaviors;

use Yii;
use yii\base\Behavior;
use yii\db\ActiveRecord;
use yii\base\InvalidParamException;

/**
 * Class AttributeUploadBehavior
 * @package common\behaviors
 *
 */
class AttributesUploadBehavior extends Behavior
{
    /**
     * @var ActiveRecord
     */
    public $owner;

    /**
     * @var behavior initializer
     */
    public $ownerName;

    /**
     * @var
     */
    public $attribute;

    /**
     * @var
     */
    public $nameAttribute;

    /**
     * @var
     */
    public $valueAttribute;

    /**
     * @var
     */
    public $tagAttribute;

    /**
     * @var string name of the relation
     */
    public $uploadRelation;

    /**
     * @var 
     */
    private $_model;


    public function events()
    {
        return[
            ActiveRecord::EVENT_AFTER_INSERT => 'afterInsertArticle',
            ActiveRecord::EVENT_AFTER_UPDATE => 'afterUpdateArticle',
        ];

    }


    public function afterInsertArticle(){


    }

    public function afterUpdateArticle(){

        $this->loadModel()->update();
        $this->owner->link($this->uploadRelation, $this->_model);
    }


    /**
     * @return mixed
     */
    public function loadModel(){
        $relationQuery = $this->owner->getRelation($this->uploadRelation);
        $this->_model = new $relationQuery->modelClass;
        $this->_model->article_id = $this->owner->id;
        $this->_model->value = $this->_loadAttributes();
        return $this->_model;
    }


    /**
     * Function load attributes
     * @return mixed
     * @throws \yii\base\InvalidParamException
     */

    protected function _loadAttributes(){
        if(!$this->owner)
            throw new InvalidParamException(get_class($this) . ' has empty owner var ');

        return $this->owner->{$this->attribute};
    }

}
