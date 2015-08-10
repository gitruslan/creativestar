<?php
    /**
     * Eugine Terentev <eugine@terentev.net>
     */

    namespace common\widgets;

    use common\models\ArticleSlider;
    use Yii;
    use yii\base\InvalidConfigException;
    use yii\bootstrap\Carousel;
    use yii\bootstrap\Widget;
    use yii\helpers\Html;
    use yii\helpers\ArrayHelper;
    use dosamigos\gallery\Gallery;

    /**
     * Class DbCarousel
     * @package common\widgets
     */
    class DbArticleSlider extends Carousel
    {
        /**
         * @var
         */
        public $key;

        /**
         * @var
         */
        public $article_id;

        /**
         * @var
         */
        public $class = 'article-slider';

        /**
         * @var array
         */
        public $controls = [
            '<div class="left carousel-control slider-control-left">

            </div>',
            '<div class="right carousel-control slider-control-right">

            </div>',
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
                ArticleSlider::className(),
                $this->key
            ];
            $items = Yii::$app->cache->get($cacheKey);
            if ($items === false) {
                $items = [];

                $query = ArticleSlider::find()
                    ->andWhere(['article_id'=>$this->article_id]);
                foreach ($query->all() as $k => $item) {
                    /** @var $item \common\models\WidgetCarouselItem */
                    if ($item->path) {
                        /*Html::img(
                            Yii::$app->glide->createSignedUrl([
                                'glide/index',
                                'path' =>  $item->path,
                                'w' => 216,
                                'h' => 134
                            ], true),
                            ['class' => 'img-rounded']
                        );*/
                        $items[$k]['src'] = Yii::$app->glide->createSignedUrl([
                            'glide/index',
                            'path' =>  $item->path,
                            'w' => 216,
                            'h' => 134
                        ], true);
                        $items[$k]['url'] = $item->getUrl();
                        $items[$k]['options'] = ['title'=>''];
                    }
                }
                Yii::$app->cache->set($cacheKey, $items, 60*60*24*365);
            }
            $this->items = $items;
            Widget::init();
            Html::addCssClass($this->options, $this->class);
        }

        /**
         * Renders the widget.
         */
        public function run()
        {
            return implode("\n", [
                Html::beginTag('div', $this->options),
              //  $this->renderIndicators(),
                Html::beginTag('div',  ['class' => 'slider-carousel-inner']),
                $this->renderItems(),
                Html::endTag('div'),
                $this->renderControls(),
                Html::endTag('div')
            ]) . "\n";
        }


        /**
         * Renders carousel items as specified on [[items]].
         * @return string the rendering result
         */
        public function renderItems()
        {
            return Gallery::widget(['items'=>$this->items]);

        }



        /**
         * Renders previous and next control buttons.
         * @throws InvalidConfigException if [[controls]] is invalid.
         */
        public function renderControls()
        {
            if (isset($this->controls[0], $this->controls[1])) {
                return $this->controls[0].$this->controls[1];
//                return Html::a($this->controls[0], '' , [
//                    'class' => 'left carousel-control slider-control-left',
//                    'data-slide' => 'prev',
//                ]) . "\n"
//                . Html::a($this->controls[1], '', [
//                    'class' => 'right carousel-control slider-control-right',
//                    'data-slide' => 'next',
//                ]);
            } elseif ($this->controls === false) {
                return '';
            } else {
                throw new InvalidConfigException('The "controls" property must be either false or an array of two elements.');
            }
        }



    }
