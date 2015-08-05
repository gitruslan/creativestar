<?php
/**
 * Eugine Terentev <eugine@terentev.net>
 */

namespace common\widgets;

use common\models\WidgetCarousel;
use common\models\WidgetCarouselItem;
use Yii;
use yii\base\InvalidConfigException;
use yii\bootstrap\Carousel;
use yii\helpers\Html;

/**
 * Class DbCarousel
 * @package common\widgets
 */
class DbCarousel extends Carousel
{
    /**
     * @var
     */
    public $key;

    /**
     * @var array
     */
    public $controls = [
        '<span class="glyphicon glyphicon-chevron-left"></span>',
        '<span class="glyphicon glyphicon-chevron-right"></span>',
    ];

    /**
     * @throws InvalidConfigException
     */
    public function init()
    {
        if (!$this->key) {
            throw new InvalidConfigException;
        }
        $cacheKey = [
            WidgetCarousel::className(),
            $this->key
        ];
        $items = Yii::$app->cache->get($cacheKey);
        if ($items === false) {
            $items = [];
            $query = WidgetCarouselItem::find()
                ->joinWith('carousel')
                ->joinWith('widgetCarouselItemImages')
                ->where([
                    '{{%widget_carousel_item}}.status' => 1,
                    '{{%widget_carousel}}.status' => WidgetCarousel::STATUS_ACTIVE,
                    '{{%widget_carousel}}.key' => $this->key,
                ])
                ->orderBy(['order' => SORT_ASC]);
            foreach ($query->all() as $k => $item) {
                /** @var $item \common\models\WidgetCarouselItem */
                if ($item->path) {
                    $items[$k]['content'] = Html::img($item->getImageUrl());
                }

                if ($item->url) {
                    $items[$k]['content'] = Html::a($items[$k]['content'], $item->url, ['target'=>'_blank']);
                }

                if ($item->caption) {
                    $items[$k]['caption'] = $item->caption;
                }

                $items[$k]['additional_images'] = [
                    'top_left_img'     => $item->top_left_img,
                    'bottom_left_img'  => $item->bottom_left_img,
                    'top_right_img'    => $item->top_right_img,
                    'bottom_right_img' => $item->bottom_right_img,
                ];
//                if ($item->top_left_img){
//                    $items[$k]['top_left_img'] = $item->top_left_img;
//                }
//                if ($item->bottom_left_img){
//                    $items[$k]['bottom_left_img'] = $item->bottom_left_img;
//                }
//                if ($item->top_right_img){
//                    $items[$k]['top_right_img'] = $item->top_right_img;
//                }
//                if ($item->bottom_right_img){
//                    $items[$k]['bottom_right_img'] = $item->bottom_right_img;
//                }
            }
            Yii::$app->cache->set($cacheKey, $items, 60*60*24*365);
        }
        $this->items = $items;
        parent::init();
    }

    /**
     * Renders the widget.
     */
    public function run()
    {
        $this->registerPlugin('carousel');
        return implode("\n", [
            Html::beginTag('div', $this->options),
            $this->renderAdditionalImages(),
            $this->renderIndicators(),
            $this->renderItems(),
            $this->renderControls(),
            Html::endTag('div')
        ]) . "\n";
    }

    /**
     * Render custom images
     */
    public function renderAdditionalImages()
    {
        $additional_images = [];
        foreach ($this->items as $item) {
            $additional_images[] = $item['additional_images'];
        }
        return HTML::tag('div','',['class'=>'additional_images','data-addimages'=>json_encode($additional_images)]);
    }
}
