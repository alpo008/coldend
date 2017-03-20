<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\MachinesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="machines-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'place') ?>

    <?= $form->field($model, 'status') ?>

    <?= $form->field($model, 'to_do') ?>

    <?php // echo $form->field($model, 'to_replace') ?>

    <?php // echo $form->field($model, 'to_order') ?>

    <?php // echo $form->field($model, 'unit_01') ?>

    <?php // echo $form->field($model, 'unit_02') ?>

    <?php // echo $form->field($model, 'unit_03') ?>

    <?php // echo $form->field($model, 'unit_04') ?>

    <?php // echo $form->field($model, 'unit_05') ?>

    <?php // echo $form->field($model, 'unit_06') ?>

    <?php // echo $form->field($model, 'unit_07') ?>

    <?php // echo $form->field($model, 'unit_08') ?>

    <?php // echo $form->field($model, 'unit_09') ?>

    <?php // echo $form->field($model, 'unit_10') ?>

    <?php // echo $form->field($model, 'unit_11') ?>

    <?php // echo $form->field($model, 'unit_12') ?>
    
    <?php // echo $form->field($model, 'unit_13') ?>
    
    <?php // echo $form->field($model, 'unit_14') ?>
    
    <?php // echo $form->field($model, 'unit_15') ?>
    
    <?php // echo $form->field($model, 'unit_16') ?>

    <?php // echo $form->field($model, 'comment') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
