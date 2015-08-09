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
                        $items[$k]['content'] = Html::img(
                            Yii::$app->glide->createSignedUrl([
                                'glide/index',
                                'path' =>  $item->path,
                                'w' => 216,
                                'h' => 134
                            ], true),
                            ['class' => 'img-rounded']
                        );
                    }

                    if ($item->url) {
                        $items[$k]['content'] = Html::a($items[$k]['content'], $item->url, ['target'=>'_blank']);
                    }

                }
                Yii::$app->cache->set($cacheKey, $items, 60*60*24*365);
            }
            $this->items = $items;
//            parent::init();
//            Html::addCssClass($this->options, $this->class);
            Widget::init();
            Html::addCssClass($this->options, $this->class);
        }

        /**
         * Renders the widget.
         */
        public function run()
        {
           // $this->registerPlugin('article-slider');
            return implode("\n", [
                Html::beginTag('div', $this->options),
                $this->renderIndicators(),
                $this->renderItems(),
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
            $items = [];
            for ($i = 0, $count = count($this->items); $i < $count; $i++) {
                $items[] = $this->renderItem($this->items[$i], $i);
            }

            return Html::tag('div', implode("\n", $items), ['class' => 'carousel-inners']);
        }

        /**
         * Renders a single carousel item
         * @param string|array $item a single item from [[items]]
         * @param integer $index the item index as the first item should be set to `active`
         * @return string the rendering result
         * @throws InvalidConfigException if the item is invalid
         */
        public function renderItem($item, $index)
        {
            if (is_string($item)) {
                $content = $item;
                $caption = null;
                $options = [];
            } elseif (isset($item['content'])) {
                $content = $item['content'];
                $caption = ArrayHelper::getValue($item, 'caption');
                if ($caption !== null) {
                    $caption = Html::tag('div', $caption, ['class' => 'carousel-caption']);
                }
                $options = ArrayHelper::getValue($item, 'options', []);
            } else {
                throw new InvalidConfigException('The "content" option is required.');
            }

            Html::addCssClass($options, 'item');
            if ($index === 0) {
                Html::addCssClass($options, 'active');
            }

            return Html::tag('div', $content . "\n" . $caption, $options);
        }


    }
