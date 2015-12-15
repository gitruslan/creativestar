<?php
/**
 * Created by PhpStorm.
 * User: ruslan
 * Date: 9/29/15
 * Time: 9:50 PM
 */

namespace mobile\widgets;

use common\widgets\DbCarousel;
use Yii;
use yii\helpers\Html;


class MobDbCarousel extends DbCarousel
{
    /**
     * Renders the widget.
     */
    public function run()
    {
        $this->registerPlugin('carousel');
        return implode("\n", [
            Html::beginTag('div', $this->options),
            $this->renderIndicators(),
            $this->renderInsideBlocks(),
            $this->renderItems(),
            $this->renderControls(),
            Html::endTag('div')
        ]) . "\n";
    }

    /**
     * Render custom outside carousel images
     * @return string
     */
    public function renderInsideBlocks(){
        return implode("\n",[
            HTML::tag('div','',['class'=>'carousel-inset-shadow']),
        ]);
    }

}