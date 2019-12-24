<?php

use yii\helpers\Html;

?>


<section id="cities" class="cities__wrap">
    <div class="container">
        <h1 class="title text-center">
            <?= $model->h1;?>
        </h1>
        <p class="cities__desc text--sub text-center">
            <?= $model->desc;?>
        </p>
        <div class="item-location__wrap">
            <?php foreach ($model->items as $item):?>
            <div class="item-location">
                <div class="item-location__img">
                    <?= Html::img($item->imgurl, ['class' => '']); ?>
                </div>
                <div class="item-location__content">
                    <div class="title--small item__title flex-center flex-center--between">
                        <a href="<?= '/'.$model->url.'/'.$item->url ;?>" class="text--blue">
                            <?= $item->h1;?>
                            <span class="text--normal">
                                (<?= $item->parent->h1;?>)
                            </span>
                        </a>
                        <a href="<?= '/'.$model->url.'/'.$item->url;?>" class="main-btn main-btn--sm">Read More</a>
                    </div>
                    <p class="item-location__desc text--small m0">
                        <?= $item->desc;?>
                    </p>
                </div>
            </div>

            <?php endforeach;?>
        </div>
    </div>

</section>

