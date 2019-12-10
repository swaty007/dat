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

    <?= $form->field($model, 'meta_header')->widget(MultipleInput::className(), [
//    'max' => 4,
//        'min' => 1,
        'addButtonPosition' => MultipleInput::POS_FOOTER,
        'columns' => [
            [
                'name'  => 'meta_key',
                'type'  => 'dropDownList',
                'title' => 'Position',
                'items' => [
                        'top' => 'Top'
                ],
                'defaultValue' => 'top',
                'options' => [
//                    'class' => 'hidden'
                ]
            ],
            [
                'name'  => 'meta_title',
                'title' => 'Header div',
                'enableError' => true,
            ],
            [
                'name'  => 'meta_value',
                'title' => 'Content span',
                'options' => [
                    'class' => 'input-priority'
                ]
            ],
        ]
    ]);?>

    <?= $form->field($model, 'html_content_top')->widget(CKEditor::className(), [
        'editorOptions' => ElFinder::ckeditorOptions(['elfinder', 'multiple' => false],[
            'preset' => 'standard', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
            'inline' => false,
        ]),
    ]); ?>
<!--    --><?//= $form->field($model, 'html_content_middle')->widget(CKEditor::className(), [
//        'editorOptions' => ElFinder::ckeditorOptions(['elfinder', 'multiple' => false],[
//            'preset' => 'standard', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
//            'inline' => false,
//        ]),
//    ]); ?>

    <?= $form->field($model, 'reasons_head')->widget(MultipleInput::className(), [
    'max' => 1,
//        'min' => 3,
        'addButtonPosition' => MultipleInput::POS_FOOTER,

        'columns' => [
            [
                'name'  => 'meta_key',
                'type'  => 'dropDownList',
                'title' => 'Position',
                'defaultValue' => 'reasons_head',
                'items' => [
                        'reasons_head' => 'Reasons top html'
                ]
            ],
            [
                'name'  => 'meta_title',
                'title' => 'Header',
                'enableError' => true,
            ],
            [
                'name'  => 'meta_value',
                'type'  => CKEditor::className(),
                'title' => 'Content html',
                'options' => [
                    'editorOptions' => ElFinder::ckeditorOptions(['elfinder', 'multiple' => false],[
                        'preset' => 'basic',
                        'inline' => false,
                    ])
                ]
            ],
        ]
    ]);?>
    <?= $form->field($model, 'reasons')->widget(MultipleInput::className(), [
//    'max' => 4,
        'min' => 3,
        'addButtonPosition' => MultipleInput::POS_FOOTER,
        'columns' => [
            [
                'name'  => 'meta_key',
                'type'  => 'dropDownList',
                'title' => 'Position',
                'defaultValue' => 'reasons',
                'items' => [
                    'reasons' => 'Reason'
                ]
            ],
            [
                'name'  => 'meta_title',
                'title' => 'Header h3',
                'enableError' => true,
            ],
            [
                'name'  => 'meta_value',
                'title' => "Content (p)",
            ],
        ]
    ]);?>

    <?= $form->field($model, 'html_content_bottom')->widget(CKEditor::className(), [
        'editorOptions' => ElFinder::ckeditorOptions(['elfinder', 'multiple' => false],[
            'preset' => 'standard', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
            'inline' => false,
        ]),
    ]); ?>


    <?= MetaTags::widget([
        'model' => $model,
        'form' => $form
    ])?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
