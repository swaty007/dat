<?php

use common\components\MetaTags;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
use unclead\multipleinput\MultipleInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Review */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="review-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'refer_link')->textInput(['maxlength' => true]) ?>

    <?php if (!empty($model->image)):?>
        <img src="<?='/img/uploads/' . $model->image?>" style="height:100px;widht:auto;">
    <?php endif;?>
    <?= $form->field($model, 'image')->fileInput() ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'h1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'h1_desc_html')->widget(CKEditor::className(), [
        'editorOptions' => ElFinder::ckeditorOptions(['elfinder', 'multiple' => false],[
            'preset' => 'standard', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
            'inline' => false,
        ]),
    ]); ?>

    <?= $form->field($model, 'pros_cons_title')->widget(MultipleInput::className(), [
    'max' => 1,
//        'min' => 3,
        'addButtonPosition' => MultipleInput::POS_FOOTER,
        'columns' => [
            [
                'name'  => 'meta_key',
                'type'  => 'dropDownList',
                'title' => 'Position',
                'defaultValue' => 'pros_cons_title',
                'items' => [
                    'pros_cons_title' => 'Pros/Cons title'
                ]
            ],
            [
                'name'  => 'meta_value',
                'title' => "Title h2",
            ],
        ]
    ]);?>
    <?= $form->field($model, 'pros')->widget(MultipleInput::className(), [
//        'max' => 1,
//        'min' => 3,
        'addButtonPosition' => MultipleInput::POS_FOOTER,
        'columns' => [
            [
                'name'  => 'meta_key',
                'type'  => 'dropDownList',
                'title' => 'Position',
                'defaultValue' => 'pros',
                'items' => [
                    'pros' => 'Pros'
                ]
            ],
            [
                'name'  => 'meta_value',
                'title' => "Value Pros div/span",
            ],
        ]
    ]);?>
    <?= $form->field($model, 'cons')->widget(MultipleInput::className(), [
//        'max' => 1,
//        'min' => 3,
        'addButtonPosition' => MultipleInput::POS_FOOTER,
        'columns' => [
            [
                'name'  => 'meta_key',
                'type'  => 'dropDownList',
                'title' => 'Position',
                'defaultValue' => 'cons',
                'items' => [
                    'cons' => 'Cons'
                ]
            ],
            [
                'name'  => 'meta_value',
                'title' => "Value Cons div/span",
            ],
        ]
    ]);?>

    <?= $form->field($model, 'desc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'html_content')->textarea(['rows' => 6]) ?>


    <?= $form->field($model, 'steps_head')->widget(MultipleInput::className(), [
        'max' => 1,
//        'min' => 3,
        'addButtonPosition' => MultipleInput::POS_FOOTER,

        'columns' => [
            [
                'name'  => 'meta_key',
                'type'  => 'dropDownList',
                'title' => 'Position',
                'defaultValue' => 'steps_head',
                'items' => [
                    'steps_head' => 'Steps top html'
                ]
            ],
            [
                'name'  => 'meta_title',
                'title' => 'Header h2',
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
    <?= $form->field($model, 'steps')->widget(MultipleInput::className(), [
//    'max' => 4,
        'min' => 3,
        'addButtonPosition' => MultipleInput::POS_FOOTER,
        'columns' => [
            [
                'name'  => 'meta_key',
                'type'  => 'dropDownList',
                'title' => 'Position',
                'defaultValue' => 'steps',
                'items' => [
                    'steps' => 'Step'
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
    <?= $form->field($model, 'steps_footer')->widget(MultipleInput::className(), [
        'max' => 1,
//        'min' => 3,
        'addButtonPosition' => MultipleInput::POS_FOOTER,

        'columns' => [
            [
                'name'  => 'meta_key',
                'type'  => 'dropDownList',
                'title' => 'Position',
                'defaultValue' => 'steps_footer',
                'items' => [
                    'steps_footer' => 'Steps footer html'
                ]
            ],
            [
                'name'  => 'meta_title',
                'title' => 'Header h2',
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

    <?= MetaTags::widget([
        'model' => $model,
        'form' => $form
    ])?>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
