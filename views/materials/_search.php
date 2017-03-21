<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\MaterialsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="materials-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'model_ref') ?>

    <?= $form->field($model, 'trade_mark') ?>

    <?= $form->field($model, 'minqty') ?>

    <?= $form->field($model, 'manufacturer') ?>

    <?php // echo $form->field($model, 'generic_usage') ?>

    <?php // echo $form->field($model, 'function') ?>

    <?php // echo $form->field($model, 'sap') ?>

    <?php // echo $form->field($model, 'type') ?>

    <?php // echo $form->field($model, 'comment_1') ?>

    <?php // echo $form->field($model, 'comment_2') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
