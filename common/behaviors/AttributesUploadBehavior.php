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
            ActiveRecord::EVENT_AFTER_FIND => 'afterFindArticle',
        ];

    }

    /**
     * Load attributes
     * @return mixed
     */
    public function afterFindArticle(){
        if(is_object($this->owner->articleAttributes)){
            return $this->owner->{$this->attribute} = $this->owner->articleAttributes->value;
        }
        return;
    }

    /**
     * Insert attributes
     */
    public function afterInsertArticle(){
        $this->_insertAttributes();
    }

    /**
     * Update attributes
     */
    public function afterUpdateArticle(){
        if(!($this->_model = $this->owner->articleAttributes)){
            $this->_insertAttributes();
        }else{
            $this->_updateAttributes($this->_model);
        }

    }

    /**
     * Insert data
     */
    protected function _insertAttributes(){
        $this->_model = $this->loadModel();
        if($this->_model->value = $this->_loadAttributes()){
            $this->_model->article_id = $this->owner->id;
            $this->_model->name = $this->attribute;
            $this->owner->link($this->uploadRelation, $this->_model);
        }
    }

    protected function _updateAttributes(&$model){
        if($value = $this->_loadAttributes()){
            $model->value = $value;
            $model->update(false);
        }else {
            $model->delete();
        }
    }

    /**
     * @return mixed
     */
    public function loadModel(){
        $relationQuery = $this->owner->getRelation($this->uploadRelation);
        return new $relationQuery->modelClass;
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
