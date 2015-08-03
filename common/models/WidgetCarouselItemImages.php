<?php

    namespace common\models;

    use Yii;
    use yii\behaviors\TimestampBehavior;

    /**
     * This is the model class for table "{{%widget_carousel_item_images}}".
     *
     * @property integer $id
     * @property integer $article_id
     * @property string $base_url
     * @property string $path
     * @property string $url
     * @property string $name
     * @property string $type
     * @property string $size
     *
     * @property Article $article
     */
    class WidgetCarouselItemImages extends \yii\db\ActiveRecord
    {
        /**
         * @inheritdoc
         */
        public static function tableName()
        {
            return '{{%widget_carousel_item_images}}';
        }

        /**
         * @inheritdoc
         */
        public function behaviors()
        {
            return [
                [
                    'class' => TimestampBehavior::className(),
                    'updatedAtAttribute' => false
                ]
            ];
        }

        /**
         * @inheritdoc
         */
        public function rules()
        {
            return [
                //[['item_id', 'path'], 'required'],
                [['item_id'], 'integer'],
                [['base_url','size','path', 'type', 'name'], 'string', 'max' => 255]
            ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels()
        {
            return [
                'id' => Yii::t('common', 'ID'),
                'item_id' => Yii::t('common', 'Item ID'),
                'base_url' => Yii::t('common', 'Base Url'),
                'path' => Yii::t('common', 'Path'),
                'size' => Yii::t('common', 'Size'),
                'type' => Yii::t('common', 'Type'),
                'name' => Yii::t('common', 'Name')
            ];
        }

        /**
         * @return \yii\db\ActiveQuery
         */
        public function getItem()
        {
            return $this->hasOne(WidgetCarouselItem::className(), ['id' => 'item_id']);
        }

        public function getUrl()
        {
            return $this->base_url .'/'. $this->path;
        }
    }
