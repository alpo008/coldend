<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use anmaslov\autocomplete\AutoComplete;

/* @var $this yii\web\View */
/* @var $model app\models\Machines */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="machines-form">

    <?php $form = ActiveForm::begin([
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-9 col-md9\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-3 col-md-3  text-left'],
        ],
    ]);
    ?>

    <div class="row">
        <div class="col-lg-5 col-md-5"><?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'place')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'status')->dropDownList($model->statusNames()); ?>

            <?= $form->field($model, 'to_do')->textarea(['rows' => 6]) ?>

            <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>

            <?= $form->field($model, 'photofile')->fileInput() ?>

            <?= $form->field($model, 'schemafile')->fileInput() ?>
        </div>

        <div class="col-lg-2 col-md-2"></div>

        <div class="col-lg-5 col-md-5">

            <?= $form->field($model, 'unit_01')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'unit_02')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'unit_03')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'unit_04')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'unit_05')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'unit_06')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'unit_07')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'unit_08')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'unit_09')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'unit_10')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'unit_11')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'unit_12')->textInput(['maxlength' => true]) ?>
            
            <?= $form->field($model, 'unit_13')->textInput(['maxlength' => true]) ?>
            
            <?= $form->field($model, 'unit_14')->textInput(['maxlength' => true]) ?>
            
            <?= $form->field($model, 'unit_15')->textInput(['maxlength' => true]) ?>
            
            <?= $form->field($model, 'unit_16')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <?= $form->field($model, 'to_replace')->textInput()->widget(
                AutoComplete::className(),
                [
                    'attribute' => 'to_replace',
                    'name' => 'Machines[to_replace]',
                    'data' => $model->partsAutocompleteList(),
                    'value' => $model->refreshAutocompleteField('parts', 'to_replace'),
                    'clientOptions' => [
                        'minChars' => 2,
                    ]
                ]);
            ?>
        </div>

        <div class="col-lg-12 col-md-12">
            <?= $form->field($model, 'to_order')->textInput()->widget(
                AutoComplete::className(),
                [
                    'attribute' => 'to_order',
                    'name' => 'Machines[to_order]',
                    'data' => $model->partsAutocompleteList(),
                    'value' => $model->refreshAutocompleteField('parts', 'to_order'),
                    'clientOptions' => [
                        'minChars' => 2,
                    ]
                ]);
            ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Save changes'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
