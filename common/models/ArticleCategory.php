<?php

namespace common\models;

use common\models\query\ArticleCategoryQuery;
use Yii;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "article_category".
 *
 * @property integer $id
 * @property string $slug
 * @property string $title
 * @property integer $status
 *
 * @property Article[] $articles
 * @property ArticleCategory $parent
 */
class ArticleCategory extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_DRAFT = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%article_category}}';
    }

    /**
     * @return ArticleCategoryQuery
     */
    public static function find()
    {
        return new ArticleCategoryQuery(get_called_class());
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            [
                'class'=>SluggableBehavior::className(),
                'attribute'=>'title'
            ]
        ];
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title'], 'string', 'max' => 512],
            [['slug'], 'unique'],
            [['lang_id'],'integer'],
            [['keywords'],'string','max'=>100],
            [['description'],'string','max'=>250],
            [['slug'], 'string', 'max' => 1024],
            ['status', 'integer'],
            ['parent_id', 'exist', 'targetClass' => ArticleCategory::className(), 'targetAttribute' => 'id']
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
            'lang_id' => Yii::t('common','Lang Id'),
            'title' => Yii::t('common', 'Title'),
            'keywords' => Yii::t('common', 'Keywords'),
            'description'=>Yii::t('common', 'Description'),
            'parent_id' => Yii::t('common', 'Parent Category'),
            'status' => Yii::t('common', 'Active')
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticles()
    {
        return $this->hasMany(Article::className(), ['category_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasMany(ArticleCategory::className(), ['id' => 'parent_id']);
    }
}
