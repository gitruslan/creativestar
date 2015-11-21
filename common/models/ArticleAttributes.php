<?php
/**
 * Created by PhpStorm.
 * User: ruslan
 * Date: 11/14/15
 * Time: 12:28 PM
 */

namespace common\models;

use Yii;
use \yii\db\ActiveRecord;

/**
 * Class ArticleAttributes
 * class table "{{%article_attributes}}"
 * @package common\models
 * @property integer article_id
 * @property string  tag
 * @property string  name
 * @property string  value
 */
class ArticleAttributes extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%article_attributes}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['article_id', 'tag'], 'required'],
            [['article_id'], 'integer'],
            [['tag', 'name','value '], 'string', 'max' => 255]
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
            'value' => Yii::t('common', 'Value attributes'),
            'name' => Yii::t('common', 'Name'),
            'tag' => Yii::t('common', 'Tag')
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticle()
    {
        return $this->hasOne(Article::className(), ['id' => 'article_id']);
    }

}
