<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use anmaslov\autocomplete\AutoComplete;

/* @var $this yii\web\View */
/* @var $model app\models\Usages */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="usages-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php // $form->field($model, 'machines_id')->textInput() ?>

    <?php // $form->field($model, 'unit_id')->textInput() ?>

    <?= $form->field($model, 'materials_id')->textInput()->widget(
        AutoComplete::className(),
        [
            'attribute' => 'materials_id',
            'name' => 'Usages[materials_id]',
            'data' => $model->partsAutocompleteList(),
            'value' => (isset ($model->partsAutocompleteList()[$model->materials_id])) ? $model->partsAutocompleteList()[$model->materials_id] : '',
            'clientOptions' => [
                'minChars' => 2,
            ]
        ]);
    ?>

    <?= $form->field($model, 'unit_qty')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
