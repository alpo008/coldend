<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use anmaslov\autocomplete\AutoComplete;

/* @var $this yii\web\View */
/* @var $model app\models\Incoms */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="incoms-form">

    <?php $form = ActiveForm::begin([
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
            'value' => (isset ($model->partsAutocompleteList()[$model->materials_id])) ? $model->partsAutocompleteList()[$model->materials_id] : '',
            'clientOptions' => [
                'minChars' => 2,
            ]
        ]);
    ?>

    <?= $form->field($model, 'qty')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'came_from')->dropDownList($model->fromDropdown()) ?>

    <?= $form->field($model, 'came_to')->dropDownList($model->toDropdown()) ?>

    <?= $form->field($model, 'responsible')->textInput(['maxlength' => true, 'value' => Yii::$app->user->identity->name . ' ' . Yii::$app->user->identity->surname]) ?>

    <?= $form->field($model, 'trans_date')->textInput(['value' => date('Y-m-d')]) ?>

    <?= $form->field($model, 'ref_doc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
