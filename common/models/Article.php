<?php

namespace common\models;

use common\models\query\ArticleQuery;
use trntv\filekit\behaviors\UploadBehavior;
use common\behaviors\SliderUploadBehavior;
use common\behaviors\MusicUploadBehavior;
use common\behaviors\AttributesUploadBehavior;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "article".
 *
 * @property integer $id
 * @property string $slug
 * @property string $title
 * @property string $body
 * @property string $view
 * @property string $thumbnail_base_url
 * @property string $thumbnail_path
 * @property array $attachments
 * @property integer $author_id
 * @property integer $updater_id
 * @property integer $category_id
 * @property integer $status
 * @property integer $published_at
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property User $author
 * @property User $updater
 * @property ArticleCategory $category
 * @property ArticleAttachment[] $articleAttachments
 * @property ArticleSlider[] $articleSlider
 */
class Article extends \yii\db\ActiveRecord
{
    const STATUS_PUBLISHED = 1;
    const STATUS_DRAFT = 0;

    /**
     * @var array
     */
    public $attachments;

    /**
     * @var array
     */
    public $slider;

    /**
     * @var array
     */
    public $thumbnail;

    /**
     * @var array
     */
    public $music;

    /**
     * @var
     */
    public $article_attributes_android_link;

    /**
     * @var
     */
    public $article_attributes_apple_link;


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%article}}';
    }

    /**
     * @return ArticleQuery
     */
    public static function find()
    {
        return new ArticleQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            [
                'class'=>BlameableBehavior::className(),
                'createdByAttribute' => 'author_id',
                'updatedByAttribute' => 'updater_id',

            ],
            [
                'class'=>SluggableBehavior::className(),
                'attribute'=>'title',
                'immutable' => true
            ],
            [
                'class' => UploadBehavior::className(),
                'attribute' => 'attachments',
                'multiple' => true,
                'uploadRelation' => 'articleAttachments',
                'pathAttribute' => 'path',
                'baseUrlAttribute' => 'base_url',
                'typeAttribute' => 'type',
                'sizeAttribute' => 'size',
                'nameAttribute' => 'name',
            ],
            [
                'class' => SliderUploadBehavior::className(),
                'attribute' => 'slider',
                'multiple' => true,
                'uploadRelation' => 'articleSlider',
                'pathAttribute' => 'path',
                'baseUrlAttribute' => 'base_url',
                'typeAttribute' => 'type',
                'sizeAttribute' => 'size',
                'nameAttribute' => 'name',
            ],
            [
                'class' => MusicUploadBehavior::className(),
                'attribute' => 'music',
                'multiple' => true,
                'uploadRelation' => 'articleMusic',
                'pathAttribute' => 'path',
                'baseUrlAttribute' => 'base_url',
                'typeAttribute' => 'type',
                'sizeAttribute' => 'size',
                'nameAttribute' => 'name',
            ],
            [
                'class' => UploadBehavior::className(),
                'attribute' => 'thumbnail',
                'pathAttribute' => 'thumbnail_path',
                'baseUrlAttribute' => 'thumbnail_base_url'
            ],
            [
                'class' => AttributesUploadBehavior::className(),
                'uploadRelation' => 'articleAttributes',
                'attribute'      => 'article_attributes_apple_link',
                'nameAttribute'  => 'name',
                'valueAttribute' => 'value',
                'tagAttribute'   => 'tag',
            ],
/*            [
                'class' => AttributesUploadBehavior::className(),
                'uploadRelation' => 'articleAttributes',
                'attribute'      => 'article_attributes_android_link',
                'nameAttribute'  => 'name',
                'valueAttribute' => 'value',
                'tagAttribute'   => 'tag',
            ],*/

        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'body'], 'required'],
            [['slug'], 'unique'],
            [['body'], 'string'],
            [['keywords'],'string','max' => 100],
            [['description'],'string','max' => 250],
            [['published_at'], 'default', 'value' => time()],
            [['published_at'], 'filter', 'filter' => 'strtotime'],
            [['category_id'], 'exist', 'targetClass' => ArticleCategory::className(), 'targetAttribute'=>'id'],
            [['author_id', 'updater_id', 'status'], 'integer'],
            [['slug', 'thumbnail_base_url', 'thumbnail_path'], 'string', 'max' => 1024],
            [['title'], 'string', 'max' => 512],
            [['view'], 'string', 'max' => 255],
            [['attachments','article_attributes_apple_link', 'thumbnail','slider','music'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'slug' => Yii::t('common', 'Slug'),
            'title' => Yii::t('common', 'Title'),
            'body' => Yii::t('common', 'Body'),
            'keywords' => Yii::t('common', 'Keywords'),
            'description'=>Yii::t('common', 'Description'),
            'view' => Yii::t('common', 'Article View'),
            'thumbnail' => Yii::t('common', 'Thumbnail'),
            'music' => Yii::t('common', 'Load music files'),
            'author_id' => Yii::t('common', 'Author'),
            'updater_id' => Yii::t('common', 'Updater'),
            'category_id' => Yii::t('common', 'Category'),
            'status' => Yii::t('common', 'Published'),
            'published_at' => Yii::t('common', 'Published At'),
            'created_at' => Yii::t('common', 'Created At'),
            'updated_at' => Yii::t('common', 'Updated At'),
            'article_attributes' => Yii::t('common', 'Android Market link'),
            'article_attributes_apple_link' => Yii::t('common', 'Apple Store link')
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'author_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdater()
    {
        return $this->hasOne(User::className(), ['id' => 'updater_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(ArticleCategory::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticleAttachments()
    {
        return $this->hasMany(ArticleAttachment::className(), ['article_id' => 'id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticleSlider()
    {
        return $this->hasMany(ArticleSlider::className(), ['article_id' => 'id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticleMusic()
    {
        return $this->hasMany(ArticleMusic::className(), ['article_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticleAttributes()
    {
        return $this->hasMany(ArticleAttributes::className(),['article_id' => 'id']);

    }


}
