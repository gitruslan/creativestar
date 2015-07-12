<?php
/**
 * Eugine Terentev <eugine@terentev.net>
 */

namespace common\widgets;

use \common\models\WidgetMenu;
use yii\base\InvalidConfigException;
use Yii;
use yii\widgets\Menu;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * Class DbMenu
 * Usage:
 * echo common\widgets\DbMenu::widget([
 *      'key'=>'stored-menu-key',
 *      ... other options from \yii\widgets\Menu
 * ])
 * @package common\widgets
 */
class DbMenu extends Menu
{

    /**
     * @var string Key to find menu model
     */
    public $key;

    public function init()
    {
        $cacheKey = [
            WidgetMenu::className(),
            $this->key
        ];
        $this->items = Yii::$app->cache->get($cacheKey);
        if ($this->items === false) {
            if (!($model = WidgetMenu::findOne(['key'=>$this->key, 'status' => WidgetMenu::STATUS_ACTIVE]))) {
                throw new InvalidConfigException;
            }
            $this->items =json_decode($model->items, true);
            Yii::$app->cache->set($cacheKey, $this->items, 60*60*24);
        }
    }

    /**
     * Reloaded function , it needs for multi lang items
     * @param array $item
     * @return string
     */
    protected function renderItem($item)
    {
        if (isset($item['url'])) {
            $template = ArrayHelper::getValue($item, 'template', $this->linkTemplate);
            return strtr($template, [
                '{url}' => Html::encode(Url::to($item['url'])),
                '{label}' => isset($item['multiLangLabel']) ?
                        Yii::t($item['multiLangLabel']['category'],
                            $item['multiLangLabel']['message']
                        ) : $item['label'],
            ]);
        } else {
            $template = ArrayHelper::getValue($item, 'template', $this->labelTemplate);

            return strtr($template, [
                '{label}' => $item['label'],
            ]);
        }
    }
}
