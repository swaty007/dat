<?php
use yii\helpers\Html;

/* @var $model common\models\Locations */


Yii::$app->metaTags->register($model);
$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'Posts'), 'url' => $model->url];
$this->params['breadcrumbs'][] = empty($this->title) ? $model->h1 : $this->title;

?>
<section id="locations" class="locations__wrap">

    <div class="locations__header" style="background-image:url('<?= $model->background_img_url; ?>');">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="title">
                        <?= $model->h1; ?>
                    </h1>
                    <p class="text--sub">
                        <?= $model->desc; ?>
                    </p>
                    <ul class="locations__list text--medium">
                        <?php foreach ($model->meta_header as $meta):?>
                            <li class="locations__list--item text--normal">
                                <span><?= $meta->meta_title; ?></span>

                                <span><?= $meta->meta_value; ?></span>
                            </li>
                        <?php endforeach;?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="locations__content locations__content--top content">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
                    <?= $model->html_content_top; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="locations__reasons reasons">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
                    <h2>
                        <?= $model->reasons_head->meta_title; ?>
                    </h2>
                    <?= $model->reasons_head->meta_value; ?>
                    <?php foreach ($model->reasons as $n => $reason):?>
                        <h3><span class="text--green">Reason <?= $n+1; ?></span> <?= $reason->meta_title; ?></h3>
                        <p><?= $reason->meta_value; ?></p>
                    <?php endforeach;?>
                </div>
            </div>
        </div>
    </div>

    <div class="locations__content locations__content--bottom content">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">

                    <?= $model->html_content_bottom; ?>

                    <div class="flex-center">
                        <a href="<?= $model->refer_link; ?>" class="main-btn">VISIT TOP SITE</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>