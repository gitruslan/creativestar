<?php
/**
 * Created by PhpStorm.
 * User: labuta
 * Date: 7/30/15
 * Time: 2:16 PM
 */

namespace common\behaviors;

use Yii;
use yii\base\Behavior;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

class CarouselItemImagesBehavior extends Behavior {
    /**
     * @var ActiveRecord
     */
    public $owner;

    /**
     * @var
     */
    public $ownerName;

    /**
     * @var string Model attribute that contain uploaded file information
     * or array of files information
     */
    public $attribute = 'file';

    /**
     * @var bool
     */
    public $multiple = false;

    /**
     * @var
     */
    public $attributePrefix;
    /**
     * @var string
     */
    public $pathAttribute;
    /**
     * @var string
     */
    public $baseUrlAttribute;
    /**
     * @var string
     */
    public $typeAttribute;
    /**
     * @var string
     */
    public $sizeAttribute;
    /**
     * @var string
     */
    public $nameAttribute;
    /**
     * @var string
     */
    public $orderAttribute;

    /**
     * @var string name of the relation
     */
    public $uploadRelation;
    /**
     * @var $uploadModel
     * Schema example:
     *      `id` INT NOT NULL AUTO_INCREMENT,
     *      `path` VARCHAR(1024) NOT NULL,
     *      `base_url` VARCHAR(255) NULL,
     *      `type` VARCHAR(255) NULL,
     *      `size` INT NULL,
     *      `name` VARCHAR(255) NULL,
     *      `order` INT NULL,
     *      `foreign_key_id` INT NOT NULL,
     */
    public $uploadModel;
    /**
     * @var string
     */
    public $uploadModelScenario = 'default';

    /**
     * @var string
     */
    public $filesStorage = 'fileStorage';

    /**
     * @var array
     */
    protected $deletePaths;
    /**
     * @var
     */
    protected $storage;
    /**
     * @return array
     */

    public function events()
    {
        return [
        return [
            ActiveRecord::EVENT_AFTER_FIND => 'afterFindAdditional',
//            ActiveRecord::EVENT_AFTER_INSERT => 'afterInsertAdditional',
            ActiveRecord::EVENT_AFTER_UPDATE => 'afterUpdateAdditional',
//            ActiveRecord::EVENT_BEFORE_DELETE => 'beforeDeleteAdditional',
//            ActiveRecord::EVENT_AFTER_DELETE => 'afterDelete'
        ];
    }


    /**
     * @return array
     */
    public function fields()
    {
        $fields = [
            'path' => $this->pathAttribute,
            'base_url' => $this->baseUrlAttribute,
            'type' => $this->typeAttribute,
            'size' => $this->sizeAttribute,
            'order' => $this->orderAttribute
        ];

        if ($this->attributePrefix !== null) {
            $fields = array_map(function ($fieldName) {
                return $this->attributePrefix . $fieldName;
            }, $fields);
        }

        return $fields;
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
     * @return array
     */
    protected function getUploaded()
    {
        if(!$this->ownerName)
            throw new InvalidParamException(get_class($this) . ' has empty ownerName var ');
        $file = Yii::$app->request->post($this->ownerName)[$this->attribute];
        return $file ? $file: [];
    }


    /**
     * @throws \Exception
     */
    public function afterUpdateAdditional()
    {
        $newPath = $this->getUploaded();
        $oldPath = $this->owner->getRelation($this->uploadRelation)->andWhere(['name'=>$this->attribute])->one();
        //empty img
        if (!count($newPath) && !count($oldPath)) {
            return;
        }
        //change image or insert new
        if (!empty($newPath) && (isset($oldPath) || !isset($oldPath))) {
            // clear if we try
            if (isset($oldPath->path)) {
                $this->getStorage()->delete($oldPath->path);
                $oldPath->delete();
            }
            $this->saveFilesToRelation($newPath);
        }
        // clear temporary saved img file storage table
        if (isset($newPath['path'])) {
          //  $this->getStorage()->delete($newPath['path']);
        }

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
    public function afterDelete()
    {
        $this->deletePaths = is_array($this->deletePaths) ? array_filter($this->deletePaths) : $this->deletePaths;
        $this->deleteFiles();
    }

    /**
     *
     */
    public function afterFindAdditional()
    {
        $models = $this->owner->{$this->uploadRelation};
        $fields = $this->fields();
        $data = [];
//        foreach ($models as $k => $model) {
//            /* @var $model \yii\db\BaseActiveRecord */
//            $file = [];
//            foreach ($fields as $dataField => $modelAttribute) {
//                $file[$dataField] = $model->hasAttribute($modelAttribute)
//                    ? ArrayHelper::getValue($model, $modelAttribute)
//                    : null;
//            }
//            if ($file['path']) {
//                $data[$k] = $this->enrichFileData($file);
//            }
//
//        }
        if(count($models) && $models[0]->name == $this->attribute){
            $data['name'] = $models[0]->name;
            $data['path'] = $models[0]->path;
            $data['base_url'] = $models[0]->base_url;
        }

        $this->owner->{$this->attribute} = $data;
    }

    /**
     * @param array $files
     */
    protected function saveFilesToRelation($file)
    {
        $modelClass = $this->getUploadModelClass();
        $model = new $modelClass;
        $model->setScenario($this->uploadModelScenario);
        $model = $this->loadModel($model, $file);

        if ($this->getUploadRelation()->via !== null) {
            $model->save(false);
        }
      //  exit(var_dump($model));
        $this->owner->link($this->uploadRelation, $model);


    }

    /**
     * @return \trntv\filekit\Storage
     * @throws \yii\base\InvalidConfigException
     */
    protected function getStorage()
    {
        if (!$this->storage) {
            $this->storage = Yii::$app->get($this->filesStorage);
        }
        return $this->storage;

    }

    /**
     * @return \yii\db\ActiveQuery|\yii\db\ActiveQueryInterface
     */
    protected function getUploadRelation()
    {
        return $this->owner->getRelation($this->uploadRelation);
    }
    /**
     * @return string
     */
    public function getUploadModelClass()
    {
        if (!$this->uploadModel) {
            $this->uploadModel = $this->getUploadRelation()->modelClass;
        }
        return $this->uploadModel;
    }

    /**
     * @param $model \yii\db\ActiveRecord
     * @param $data
     * @return \yii\db\ActiveRecord
     */
    protected function loadModel(&$model, $data)
    {
//        var_dump($model->attributes);
//        var_dump($data);
        $attributes = array_flip($model->attributes());
        foreach ($this->fields() as $dataField => $modelField) {
            if ($modelField && array_key_exists($modelField, $attributes)) {
                $model->{$dataField} =  ArrayHelper::getValue($data, $dataField);
            }
        }
        $model->name = $this->attribute;
        return $model;
    }

    /**
     * @param $type
     * @return mixed
     */
    protected function getAttributeField($type)
    {
        return ArrayHelper::getValue($this->fields(), $type, false);
    }

    /**
     * @return bool|void
     */
    protected function deleteFiles()
    {
        $storage = $this->getStorage();
        if ($this->deletePaths !== null) {
            return is_array($this->deletePaths)
                ? $storage->deleteAll($this->deletePaths)
                : $storage->delete($this->deletePaths);
        }
        return true;
    }

    /**
     * @param $file
     * @return mixed
     */
    protected function enrichFileData($file)
    {
        $fs = $this->getStorage()->getFilesystem();
        if ($file['path'] && $fs->has($file['path'])) {
            $data = [
                'type' => $fs->getMimetype($file['path']),
                'size' => $fs->getSize($file['path']),
                'timestamp' => $fs->getTimestamp($file['path'])
            ];
            foreach ($data as $k => $v) {
                if (!array_key_exists($k, $file) || !$file[$k]) {
                    $file[$k] = $v;
                }
            }
        }
        return $file;
    }



}