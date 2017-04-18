<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use anmaslov\autocomplete\AutoComplete;

/* @var $this yii\web\View */
/* @var $model app\models\Outcomes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="outcomes-form">

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
            'name' => 'Outcomes[materials_id]',
            'data' => $model->partsAutocompleteList(),
            'value' => $model->refreshAutocompleteField('parts', 'materials_id'),
            'clientOptions' => [
                'minChars' => 2,
            ]
        ]);
    ?>

    <?= $form->field($model, 'came_from')->dropDownList($model->fromDropdown()) ?>

    <?= $form->field($model, 'qty')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'came_to')->textInput()->widget(
        AutoComplete::className(),
        [
            'attribute' => 'came_to',
            'name' => 'Outcomes[came_to]',
            'data' => $model->machinesAutocompleteList(),
            'value' => $model->refreshAutocompleteField('machines', 'came_to'),//(isset ($model->machinesAutocompleteList()[$model->came_to])) ? $model->machinesAutocompleteList()[$model->materials_id] : '',
            'clientOptions' => [
                'minChars' => 2,
            ]
        ]);
    ?>

    <?= $form->field($model, 'responsible')->textInput(['maxlength' => true, 'value' => (!!Yii::$app->user->identity) ? Yii::$app->user->identity->name . ' ' . Yii::$app->user->identity->surname : '']) ?>

    <?= $form->field($model, 'trans_date')->textInput(['value' => date('Y-m-d')]) ?>

    <?= $form->field($model, 'purpose')->dropDownList($model->purposeDropdown()) ?>

    <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Save changes'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
