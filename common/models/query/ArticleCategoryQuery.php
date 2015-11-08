<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 7/4/14
 * Time: 2:31 PM
 */

namespace common\models\query;

use common\models\ArticleCategory;
use rlabuta\langmanager\models\Lang;
use yii\db\ActiveQuery;

class ArticleCategoryQuery extends ActiveQuery
{
    /**
     * @return $this
     */
    public function active($slug = null)
    {
        $this->andWhere(['slug'=>$slug]);
        $this->andWhere(['status' => ArticleCategory::STATUS_ACTIVE]);
        $this->andWhere(['lang_id'=> Lang::getCurrent()->id]);

        return $this;
    }

    /**
     * @return $this
     */
    public function activeForAdmin($slug = null)
    {
        $this->andWhere(['status' => ArticleCategory::STATUS_ACTIVE]);
        $this->andWhere(['lang_id'=> Lang::getCurrent()->id]);

        return $this;
    }

    /**
     * @return $this
     */
    public function noParents()
    {
        $this->andWhere('{{%article_category}}.parent_id IS NULL');

        return $this;
    }
}
