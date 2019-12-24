<?php

use yii\helpers\Html;

?>


<section id="blog" class="blog__wrap">
    <div class="container">
        <h1 class="title text-center">
            <?= $model->h1;?>
        </h1>
        <p class="blog__desc text--sub text-center">
            <?= $model->desc;?>
        </p>
        <div class="item-blog__wrap">
            <?php foreach ($model->items as $item):?>
                <div class="item-blog">
                    <div class="item-blog__img">
                        <?= Html::img($item->background_img_url, ['class' => '']); ?>
                    </div>
                    <div class="item-blog__content">

                        <a href="<?= '/'.$model->url.'/'.$item->url;?>" class="text--blue title--small item__title">
                            <?= $item->h1;?>
                        </a>


                        <p class="item-blog__desc text--small m0">
                            <?= $item->anons;?>
                        </p>
                        <a href="<?= '/'.$model->url.'/'.$item->url;?>" class="main-btn main-btn--sm">Read More</a>
                        <?= $item->publish_date;?>
                    </div>
                </div>

            <?php endforeach;?>
        </div>
    </div>

</section>

