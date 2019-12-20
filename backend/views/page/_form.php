<?php

use common\components\MetaTags;
use common\models\Page;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Page */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="page-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <?php if (!empty($model->background_img)):?>
        <img src="<?='/img/uploads/' . $model->background_img?>" style="height:100px;widht:auto;">
    <?php endif;?>
    <?= $form->field($model, 'background_img')->fileInput() ?>

    <?= $form->field($model, 'h1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'desc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'template')->radioList(Page::TEMPLATES) ?>

    <?= MetaTags::widget([
        'model' => $model,
        'form' => $form
    ])?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('backend', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
