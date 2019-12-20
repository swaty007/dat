<?php
use yii\helpers\Html;

/* @var $model common\models\Post */


Yii::$app->metaTags->register($model);
$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'Posts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<section class="blog__open">

    <div class="blog__header">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h1>
                        <?= $model->h1; ?>
                    </h1>
                    <p>
                        <?= $model->desc; ?>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="blog__content content">
        <div class="container">
            <?= $model->content; ?>
        </div>
    </div>
</section>