<?php
use yii\helpers\Html;

/* @var $model common\models\Post */


Yii::$app->metaTags->register($model);
$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'Posts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<section class="blog__open">

    <?= $this->render('../components/_post', ['model' => $model]); ?>
</section>