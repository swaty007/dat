<?php
use yii\helpers\Html;

/* @var $model common\models\Locations */


Yii::$app->metaTags->register($model);
$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'Posts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<section class="locations__open">

    <div class="locations__header">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h1>
                        <?= $model->h1; ?>
                    </h1>
                    <p>
                        <?= $model->desc; ?>
                    </p>
                    <div class="row">
                        <?php foreach ($model->meta_header as $meta):?>
                            <div class="col-xs-6">
                                <span><?= $meta->meta_title; ?></span>
                            </div>
                            <div class="col-xs-6">
                                <span><?= $meta->meta_value; ?></span>
                            </div>
                        <?php endforeach;?>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="locations__content content">
        <div class="container">
            <?= $model->html_content_top; ?>
        </div>
    </div>

    <div class="locations__reasons reasons">
        <div class="container">
            <?= $model->reasons_head; ?>
            <?php foreach ($model->reasons as $n => $reason):?>
            <h3><span><?= $n+1; ?></span> <?= $reason->meta_title; ?></h3>
            <p><?= $reason->meta_value; ?></p>
            <?php endforeach;?>
        </div>
    </div>

    <div class="locations__content content">
        <div class="container">
            <?= $model->html_content_bottom; ?>

            <a href="<?= $model->refer_link; ?>" class="main-btn">VISIT TOP SITE</a>
        </div>
    </div>

</section>