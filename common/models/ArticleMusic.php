<?php
/**
 * Created by PhpStorm.
 * User: ruslan
 * Date: 8/9/15
 * Time: 10:37 PM
 */
namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%article_music}}".
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
class ArticleMusic extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%article_music}}';
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
            [['article_id', 'path'], 'required'],
            [['article_id', 'size'], 'integer'],
            [['base_url', 'path', 'type', 'name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'article_id' => Yii::t('common', 'Article ID'),
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
    public function getArticle()
    {
        return $this->hasOne(Article::className(), ['id' => 'article_id']);
    }

    public function getUrl()
    {
        return $this->base_url .'/'. $this->path;
    }
}
