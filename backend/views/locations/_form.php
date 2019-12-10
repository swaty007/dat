<?php

use common\components\MetaTags;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use unclead\multipleinput\MultipleInput;

/* @var $this yii\web\View */
/* @var $model common\models\Locations */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="locations-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'parent_id')->textInput() ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'refer_link')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'h1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'desc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'html_content_top')->widget(CKEditor::className(), [
        'editorOptions' => ElFinder::ckeditorOptions(['elfinder', 'multiple' => false],[
            'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
            'inline' => false,
        ]),
    ]); ?>
    <?= $form->field($model, 'html_content_middle')->widget(CKEditor::className(), [
        'editorOptions' => ElFinder::ckeditorOptions(['elfinder', 'multiple' => false],[
            'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
            'inline' => false,
        ]),
    ]); ?>
    <?= $form->field($model, 'html_content_bottom')->widget(CKEditor::className(), [
        'editorOptions' => ElFinder::ckeditorOptions(['elfinder', 'multiple' => false],[
            'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
            'inline' => false,
        ]),
    ]); ?>

    <?= $form->field($model, 'model_meta')->widget(MultipleInput::className(), [
//    'max' => 4,
        'min' => 3,
        'addButtonPosition' => MultipleInput::POS_FOOTER,

        'columns' => [
            [
                'name'  => 'meta_key',
                'type'  => 'dropDownList',
                'title' => 'Position',
                'items' => \common\models\ModelMeta::LOCATION_KEYS
            ],
            [
                'name'  => 'meta_title',
                'title' => 'Header',
                'enableError' => true,
                'options' => [
                    'class' => 'input-priority'
                ]
            ],
            [
                'name'  => 'meta_value',
                'type'  => CKEditor::className(),
                'title' => 'Content',
                'options' => [
                    'editorOptions' => ElFinder::ckeditorOptions(['elfinder', 'multiple' => false],[
                        'preset' => 'basic',
                        'inline' => false,
                    ])
                ]
            ],
        ]
    ]);?>
    <?= MetaTags::widget([
        'model' => $model,
        'form' => $form
    ])?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
