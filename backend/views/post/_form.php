<?php

use common\components\MetaTags;
use common\models\Post;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;

/* @var $this yii\web\View */
/* @var $model common\models\Post */
/* @var $form yii\widgets\ActiveForm */
/* @var $authors yii\db\ActiveRecord[] */
/* @var $category yii\db\ActiveRecord[] */
/* @var $tags yii\db\ActiveRecord[] */
?>

<div class="post-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'category_id')->dropDownList(
        ArrayHelper::map($category, 'id', 'title')
    ) ?>

    <?= $form->field($model, 'author_id')->dropDownList(
        ArrayHelper::map($authors, 'id', 'username')
    ) ?>

    <?= $form->field($model, 'anons')->textarea(['rows' => 6]) ?>


    <?= $form->field($model, 'content')->widget(CKEditor::className(), [
        'editorOptions' => ElFinder::ckeditorOptions(['elfinder', 'multiple' => false],[
            'preset' => 'standard', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
            'inline' => false,
        ]),
    ]); ?>

    <?= $form->field($model, 'publish_status')->dropDownList(
        [Post::STATUS_DRAFT => Yii::t('backend', 'Draft'), Post::STATUS_PUBLISH => Yii::t('backend', 'Published')]
    ) ?>

    <?= $form->field($model, 'tags')->checkboxList(
        ArrayHelper::map($tags, 'id', 'title')
    ) ?>

    <?= $form->field($model, 'publish_date')->textInput() ?>
    <?= MetaTags::widget([
        'model' => $model,
        'form' => $form
    ])?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
