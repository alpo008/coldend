<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use anmaslov\autocomplete\AutoComplete;

/* @var $this yii\web\View */
/* @var $model app\models\Incoms */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="incoms-form">

    <?php
    $update = !$model->isNewRecord;
    $form = ActiveForm::begin([
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-9 col-md9\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-3 col-md-3  text-left'],
        ],
    ]); ?>

    <?= $form->field($model, 'materials_id')->textInput()->widget(
        AutoComplete::className(),
        [
            'attribute' => 'materials_id',
            'name' => 'Incoms[materials_id]',
            'data' => $model->partsAutocompleteList(),
            'value' => $model->refreshAutocompleteField('parts', 'materials_id'),
            'options' => ['disabled' => $update],
            'clientOptions' => [
                'minChars' => 2,
            ]
        ]);
    ?>

    <?= $form->field($model, 'qty')->textInput(['maxlength' => true, 'disabled' => $update]) ?>

    <?= $form->field($model, 'came_from')->dropDownList($model->fromDropdown(), ['disabled' => $update]) ?>

    <?= $form->field($model, 'came_to')->dropDownList($model->toDropdown(), ['disabled' => $update]) ?>

    <?= $form->field($model, 'responsible')->textInput(['maxlength' => true, 'value' => ($update) ? $model->responsible : ((!!Yii::$app->user->identity) ? Yii::$app->user->identity->name . ' ' . Yii::$app->user->identity->surname : '')]) ?>

    <?= $form->field($model, 'trans_date')->textInput(['placeholder' => 'DD.MM.YYYY или YYYY-MM-DD']) ?>

    <?= $form->field($model, 'ref_doc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Save changes'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
