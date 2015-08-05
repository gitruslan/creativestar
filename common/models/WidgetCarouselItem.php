<?php

namespace common\models;

use common\behaviors\CacheInvalidateBehavior;
use trntv\filekit\behaviors\UploadBehavior;
use common\behaviors\CarouselItemImagesBehavior;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "widget_carousel_item".
 *
 * @property integer $id
 * @property integer $carousel_id
 * @property string $base_url
 * @property string $path
 * @property string $type
 * @property string $image
 * @property string $imageUrl
 * @property string $url
 * @property string $caption
 * @property integer $status
 * @property integer $order
 * @property integer $top_left_img
 * @property integer $bottom_left_img
 * @property integer $top_right_img
 * @property integer $bottom_right_img

 * @property WidgetCarousel $carousel
 */
class WidgetCarouselItem extends \yii\db\ActiveRecord
{

    /**
     * @var array|null
     */
    public $image;

    /**
     * @var
     */
    public $top_left_img;

    /**
     * @var
     */
    public $bottom_left_img;

    /**
     * @var
     */
    public $top_right_img;

    /**
     * @var
     */
    public $bottom_right_img;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%widget_carousel_item}}';
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $key = array_search('carousel_id', $scenarios[self::SCENARIO_DEFAULT], true);
        $scenarios[self::SCENARIO_DEFAULT][$key] = '!carousel_id';
        return $scenarios;
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            [
                'class' => UploadBehavior::className(),
                'attribute' => 'image',
                'pathAttribute' => 'path',
                'baseUrlAttribute' => 'base_url',
                'typeAttribute' => 'type'
            ],
            [
                'class' => CarouselItemImagesBehavior::className(),
                'attribute' => 'top_left_img',
                'uploadRelation' => 'widgetCarouselItemImages',
                'pathAttribute' => 'path',
                'baseUrlAttribute' => 'base_url',
                'typeAttribute' => 'type',
                'nameAttribute' => 'top_left_img',
                'ownerName' => 'WidgetCarouselItem'
            ],
            [
                'class' => CarouselItemImagesBehavior::className(),
                'attribute' => 'bottom_left_img',
                'uploadRelation' => 'widgetCarouselItemImages',
                'pathAttribute' => 'path',
                'baseUrlAttribute' => 'base_url',
                'typeAttribute' => 'type',
                'nameAttribute' => 'bottom_left_img',
                'ownerName' => 'WidgetCarouselItem'
            ],
            [
                'class' => CarouselItemImagesBehavior::className(),
                'attribute' => 'top_right_img',
                'uploadRelation' => 'widgetCarouselItemImages',
                'pathAttribute' => 'path',
                'baseUrlAttribute' => 'base_url',
                'typeAttribute' => 'type',
                'nameAttribute' => 'top_right_img',
                'ownerName' => 'WidgetCarouselItem'
            ],
            [
                'class' => CarouselItemImagesBehavior::className(),
                'attribute' => 'bottom_right_img',
                'uploadRelation' => 'widgetCarouselItemImages',
                'pathAttribute' => 'path',
                'baseUrlAttribute' => 'base_url',
                'typeAttribute' => 'type',
                'nameAttribute' => 'bottom_right_img',
                'ownerName' => 'WidgetCarouselItem'
            ],
            'cacheInvalidate'=>[
                'class' => CacheInvalidateBehavior::className(),
                'keys' => [
                    function ($model) {
                        return [
                            WidgetCarousel::className(),
                            $model->carousel->key
                        ];
                    }
                ]
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['carousel_id'], 'required'],
            [['carousel_id', 'status', 'order'], 'integer'],
            [['url', 'caption', 'base_url', 'path'], 'string', 'max' => 1024],
            [['type'], 'string', 'max' => 45],
            ['image', 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'carousel_id' => Yii::t('common', 'Carousel ID'),
            'image' => Yii::t('common', 'Image'),
            'top_left_img' => Yii::t('common', 'Top Left Image'),
            'top_right_img' => Yii::t('common', 'Top Right Image'),
            'bottom_left_img' => Yii::t('common', 'Bottom Left Image'),
            'bottom_right_img' => Yii::t('common', 'Bottom Right Image'),
            'additionalImages1' => Yii::t('common', 'additionalImages1'),
            'base_url' => Yii::t('common', 'Base URL'),
            'path' => Yii::t('common', 'Path'),
            'type' => Yii::t('common', 'File Type'),
            'url' => Yii::t('common', 'Url'),
            'caption' => Yii::t('common', 'Caption'),
            'status' => Yii::t('common', 'Status'),
            'order' => Yii::t('common', 'Order')
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCarousel()
    {
        return $this->hasOne(WidgetCarousel::className(), ['id' => 'carousel_id']);
    }

    /**
     * @return string
     */
    public function getImageUrl()
    {
        return rtrim($this->base_url, '/') . '/' . ltrim($this->path, '/');
    }

    /**
     * @param $attr
     * @return string
     */

    public function getAdditionalImage($attr){
        return rtrim($this->{$attr}->base_url, '/') . '/' . ltrim($this->{$attr}->path, '/');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWidgetCarouselItemImages()
    {
        return $this->hasMany(WidgetCarouselItemImages::className(), ['item_id' => 'id']);
    }
}
