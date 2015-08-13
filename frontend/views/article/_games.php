<?php
    use \frontend\widgets\DropDownArticleList;
    use common\widgets\DbArticleSlider;

    /* @var $this yii\web\View */
    /* @var $model common\models\Article */
    /* @var $articles common\models\Article */
    $this->title = $model->title;
    $this->registerMetaTag([
        'name'=>'description',
        'content'=>$model->description
    ]);
    $this->registerMetaTag([
        'name'=>'keywords',
        'content'=>$model->keywords
    ]);
    $this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', $model->category->title), 'url' => '/'.$model->category->slug];
    $this->params['breadcrumbs'][] = $this->title;
?>
<div class="content">
   <?= DropDownArticleList::widget([
       'category' => $model->category->slug,
       'name'=>'Choose game',
   ]); ?>
    <div class="clear"></div>
    <div class="article-item-game">
        <div class="article-item-title-game">
            <div class="game-title"><?php echo $model->title ?></div>
        </div>
        <div class="article-item-image-game">
            <?php if ($model->thumbnail_path): ?>
                <?php echo \yii\helpers\Html::img(
                    Yii::$app->glide->createSignedUrl([
                        'glide/index',
                        'path' => $model->thumbnail_path,
                        'w' => 733,
                        'h' => 435
                    ], true),
                    ['class' => 'img-rounded']
                ) ?>
            <?php endif; ?>
            <div class="games-underline"></div>
        </div>
        <div class="article-item-body-game">
            <?php echo $model->body ?>
        </div>
        <?php if(!empty($model->articleSlider)):?>
            <?php echo DbArticleSlider::widget(
                [
                    'article_id'=>$model->id,
                    'key'=>$model->id,
                ]
            )?>
        <?php endif;?>
        <div class="games-underline-after-body"></div>
        <?php $c = 0; if (!empty($model->articleAttachments)):?>
          <div class="article-attachments">
            <div class="press-kit"><?php echo Yii::t('frontend', 'PRESS KIT') ?></div>
            <?php
                foreach ($model->articleAttachments as $attachment):
                    if($c % 2){
                        $style = 'sky';
                    } else $style = 'blue';
                ?>
                <div class="article-attachments-item <?php echo $style;?>">
                    <?php if(stristr($attachment->type,'image')):?>
                        <div class="item-img">
                            <?php echo \yii\helpers\Html::img(
                                Yii::$app->glide->createSignedUrl([
                                    'glide/index',
                                    'path' =>  $attachment->path,
                                    'w' => 75,
                                    'h' => 69
                                ], true),
                                ['class' => 'img-rounded']
                            ) ?>
                        </div>
                    <?php endif;?>
                    <div class="item-download">
                        <?php echo \yii\helpers\Html::a(
                            'download',
                            ['attachment-download', 'id' => $attachment->id])
                        ?>
                    </div>

                    <div class="item-description">
                        <?php echo '<b>'.Yii::t('frontend', 'Screenshots').'</b> / '.
                            Yii::t('frontend', 'Size').':'.Yii::$app->formatter->asShortSize($attachment->size,2) ?>
                    </div>

                </div>
            <?php $c++; endforeach; ?>

        <?php endif; ?>
        <?php if($model->articleMusic):?>
            <?php
            foreach ($model->articleMusic as $music):
                if($c % 2){
                    $style = 'sky';
                } else $style = 'blue';
                ?>
          <div class="article-attachments-item <?php echo $style;?>">
              <div class="music-name"><?=$music->name." ".Yii::t('frontend', 'soundtrack')?></div>
              <div class="music-player">
                  <audio controls class="music-player">
                      <source src="<?=$music->getUrl();?>" type="<?=$music->type;?>">
                      Your browser does not support the audio element.
                  </audio>
              </div>
          </div>
           <?php $c++; endforeach; ?>
        <?php endif;?>
       </div>

    </div>
</div>