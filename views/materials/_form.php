<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use anmaslov\autocomplete\AutoComplete;

/* @var $this yii\web\View */
/* @var $model app\models\Materials */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="materials-form">

    <?php $form = ActiveForm::begin([
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-9 col-md9\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-3 col-md-3  text-left'],
        ],
    ]);
    ?>

    <?php //$form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'model_ref')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'trade_mark')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'manufacturer')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'generic_usage')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'function')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sap')->textInput() ?>

    <?= $form->field($model, 'type')->dropDownList($model->typesDropdown()) ?>

    <?= $form->field($model, 'analog')->textInput()->widget(
        AutoComplete::className(),
        [
            'attribute' => 'analog',
            'name' => 'Materials[analog]',
            'data' => (isset ($model->type)) ? $model->analogsAutocompleteList($model->type) : $model->analogsAutocompleteList(false),
            'value' => (isset ($model->analogsAutocompleteList($model->type)[$model->analog])) ? $model->analogsAutocompleteList($model->type)[$model->analog] : '',
            'clientOptions' => [
                'minChars' => 2,
            ]
        ]);
    ?>

    <?= $form->field($model, 'minqty')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'unit')->dropDownList($model->unitsDropdown()) ?>

    <?= $form->field($model, 'at_stock')->textInput(['maxlength' => true, 'disabled' => true]) ?>

    <?= $form->field($model, 'at_dept')->textInput(['maxlength' => true, 'disabled' => true]) ?>

    <?= $form->field($model, 'comment_1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'comment_2')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'imagefile')->fileInput() ?>

    <?= $form->field($model, 'docfile')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Save changes'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
