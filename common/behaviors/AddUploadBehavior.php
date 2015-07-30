<?php
/**
 * Created by PhpStorm.
 * User: labuta
 * Date: 7/30/15
 * Time: 2:16 PM
 */

namespace common\behaviors;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use trntv\filekit\behaviors\UploadBehavior;

class AddUploadBehavior extends UploadBehavior {
    /*
     *  @var string name of the relation
     */
    public $additionalRelation;

    /**
     * @return array
     */

    public function events()
    {
        return $additionalEvents = [
            ActiveRecord::EVENT_AFTER_FIND => 'afterFindAdditional',
            ActiveRecord::EVENT_AFTER_INSERT => 'afterInsertAdditional',
            ActiveRecord::EVENT_AFTER_UPDATE => 'afterUpdateAdditional',
            ActiveRecord::EVENT_BEFORE_DELETE => 'beforeDeleteAdditional',
            ActiveRecord::EVENT_AFTER_DELETE => 'afterDelete'
        ];
    }


    /**
     *
     */
    public function afterInsertAdditional()
    {
        if ($this->owner->{$this->attribute}) {
            $this->saveFilesToRelation($this->owner->{$this->attribute});
        }
    }

    /**
     * @throws \Exception
     */
    public function afterUpdateAdditional()
    {
        $filesPaths = ArrayHelper::getColumn($this->getUploaded(), 'path');
        $models = $this->owner->getRelation($this->uploadRelation)->all();
        $modelsPaths = ArrayHelper::getColumn($models, $this->getAttributeField('path'));
        $newFiles = [];

        foreach ($models as $model) {
            $path = $model->getAttribute($this->getAttributeField('path'));
            if (!in_array($path, $filesPaths, true) && $model->delete()) {
                $this->getStorage()->delete($path);
            }
        }


        foreach ($this->getUploaded() as $file) {
            if (!in_array($file['path'], $modelsPaths, true)) {
                $newFiles[] = $file;
            }
        }

        echo "<pre>";
        print_r($this->getUploaded());
        print_r($modelsPaths);
        print_r($newFiles);
        exit('</pre>');

        $this->saveFilesToRelation($newFiles);
    }

    /**
     *
     */
    public function beforeDeleteAdditional()
    {
        $this->deletePaths = ArrayHelper::getColumn($this->getUploaded(), 'path');
    }

    /**
     *
     */
    public function afterFindAdditional()
    {
        $models = $this->owner->{$this->uploadRelation};
        $fields = $this->fields();
        $data = [];
        foreach ($models as $k => $model) {
            /* @var $model \yii\db\BaseActiveRecord */
            $file = [];
            foreach ($fields as $dataField => $modelAttribute) {
                $file[$dataField] = $model->hasAttribute($modelAttribute)
                    ? ArrayHelper::getValue($model, $modelAttribute)
                    : null;
            }
            if ($file['path']) {
                $data[$k] = $this->enrichFileData($file);
            }

        }
        $this->owner->{$this->attribute} = $data;
    }




}