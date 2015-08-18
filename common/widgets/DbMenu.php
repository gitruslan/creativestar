<?php
/**
 * Eugine Terentev <eugine@terentev.net>
 */

namespace common\widgets;

use \common\models\WidgetMenu;
use \common\models\Lang;
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
                '{url}' => Html::encode(Yii::$app->urlManager->createUrl($item['url'])),
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

    /**
     * Checks whether a menu item is active.
     * This is done by checking if [[route]] and [[params]] match that specified in the `url` option of the menu item.
     * When the `url` option of a menu item is specified in terms of an array, its first element is treated
     * as the route for the item and the rest of the elements are the associated parameters.
     * Only when its route and parameters match [[route]] and [[params]], respectively, will a menu item
     * be considered active.
     * @param array $item the menu item to be checked
     * @return boolean whether the menu item is active
     */
    protected function isItemActive($item)
    {
        $langUrl = '/'.Lang::getCurrent()->url.$item['url'];
        // detect default page
        if ($item['url'] == '/'
            && ($langUrl.Yii::$app->defaultRoute == URL::current())) {
            return true;
        }
        if (stristr(URL::current(),$langUrl) && $item['url'] != '/')
            return true;
// TODO temporary hide
//        if (isset($item['url']) && is_array($item['url']) && isset($item['url'][0])) {
//
//            $route = $item['url'][0];
//            if ($route[0] !== '/' && Yii::$app->controller) {
//                $route = Yii::$app->controller->module->getUniqueId() . '/' . $route;
//            }
//            if (ltrim($route, '/') !== $this->route) {
//                return false;
//            }
//            unset($item['url']['#']);
//            if (count($item['url']) > 1) {
//                $params = $item['url'];
//                unset($params[0]);
//                foreach ($params as $name => $value) {
//                    if ($value !== null && (!isset($this->params[$name]) || $this->params[$name] != $value)) {
//                        return false;
//                    }
//                }
//            }
//
//            return true;
//        }

        return false;
    }

}
