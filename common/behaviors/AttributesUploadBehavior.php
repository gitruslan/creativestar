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

/**
 * Class AttributeUploadBehavior
 * @package common\behaviors
 *
 */
class AttributesUploadBehavior extends Behavior
{
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
        $this->fillModelAttributes();
    }


    /**
     * @return mixed
     */
    public function getAttributesModel(){
        $relationQuery = $this->owner->getRelation($this->uploadRelation);
        return new $relationQuery->modelClass();
    }

    public function fillModelAttributes(){
        var_dump($_POST);
        exit($this->valueAttribute." -- ".$this->nameAttribute);
    }

}
