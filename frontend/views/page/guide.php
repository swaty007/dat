<?php

use yii\helpers\Html;

?>


<section id="guide" class="guide__wrap">
    <div class="container">
        <h1 class="title text-center">
            <?= $model->h1;?>
        </h1>
        <p class="guide__desc text--sub text-center">
            <?= $model->desc;?>
        </p>
        <div class="item-guide__wrap">
            <?php foreach ($model->items as $item):?>
                <div class="item-guide">
                    <div class="item-guide__img">
                        <?= Html::img($item->background_img_url, ['class' => '']); ?>
                    </div>
                    <div class="item-guide__content">
                        <div class="title--small item__title flex-center flex-center--between">
                            <a href="<?= '/'.$model->url.'/'.$item->url;?>" class="text--blue">
                                <?= $item->h1;?>
                            </a>
                        </div>
                        <p class="item-guide__desc text--small m0">
                            <?= $item->anons;?>
                        </p>
                        <a href="<?= '/'.$model->url.'/'.$item->url;?>" class="main-btn main-btn--sm">Read More</a>
                    </div>
                </div>

            <?php endforeach;?>
        </div>
    </div>

</section>

