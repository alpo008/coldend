<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Orders */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="row">
    <div class="orders-form col-lg-6 col-md-6">

        <?php
        $update = !$model->isNewRecord;
        $model->incomeTo = 0;
        $form = ActiveForm::begin([
            'layout' => 'horizontal',
            'fieldConfig' => [
                'template' => "{label}\n<div class=\"col-lg-9 col-md9\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
                'labelOptions' => ['class' => 'col-lg-3 col-md-3  text-left'],
            ],
        ]);
        ?>

        <?= $form->field($model, 'ref_doc')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'responsible')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'created', ['options' => ['class' => 'hidden']])->textInput(['value' => ($update) ? $model->created : date('Y-m-d H:i:s')]) ?>

        <?= $form->field($model, 'updated', ['options' => ['class' => 'hidden']])->textInput(['value' => ($update) ? $model->created : date('Y-m-d H:i:s')]) ?>

        <?= $form->field($model, 'status')->dropDownList($model->statusesDropdown(),
            ['options' => [
            '0' => ['disabled' => (isset ($model->status)) ? ($model->status > 2) : false],
            '1' => ['disabled' => $model->isNewRecord ? true :((isset ($model->status)) ? ($model->status > 2) : false)],
            '2' => ['disabled' => $model->isNewRecord ? true :((isset ($model->status)) ? ($model->status > 2) : false)],
            '3' => ['disabled' => $model->isNewRecord ? true : ((isset ($model->status)) ? ($model->status > 3) : false)],
            '4' => ['disabled' => $model->isNewRecord ? true : ((isset ($model->status)) ? ($model->status > 4) : false)],
            '5' => ['disabled' => $model->isNewRecord ? true : ((isset ($model->status)) ? ($model->status > 3) : false)],
            ]
        ]) ?>


        <?= Html::checkbox('create-incoms', false, ['label' => Yii::t('app', 'Create incoms for all items'), 'labelOptions' => ['class' => 'incoms-switch']] ) ?>

        <?= $form->field($model, 'incomeTo', ['labelOptions'=>['class'=>'col-lg-11 col-md-11']])->radioList([0 => 'Default',1 => Yii::t('app', 'Department'), 2 => Yii::t('app', 'Factory stock')]) ?>

        <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Save changes'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

<?php if (isset($listsModel)): ?>
    <div class="col-lg-1 col-md-1"></div>

    <div class="col-lg-5 col-md-5">
        <?php include('lists_view.php'); ?>
    </div>
<?php endif;?>

</div>

<?php if (isset($listsModel) && $editable): ?>
    <div class="col-lg-7 col-md-7"></div>
    <div class="col-lg-5 col-md-5">
        <?php include ('lists_form.php');?>
    </div>

<?php endif;?>
