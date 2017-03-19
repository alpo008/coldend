<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Machines */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="machines-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'place')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'to_do')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'to_replace')->textInput() ?>

    <?= $form->field($model, 'to_order')->textInput() ?>

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

    <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
