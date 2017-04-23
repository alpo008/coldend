<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use anmaslov\autocomplete\AutoComplete;

$this->registerJs(
    '$("document").ready(function(){
    
        $("#lists-form").on("pjax:end", function() {
        $.pjax.reload({container:"#lists-table",timeout:1000});
        });            
    });'
);
?>

<div class="clists-form">
    <?php Pjax::begin(['id' => 'lists-form']); ?>
        <?php $form = ActiveForm::begin(['options' => ['data-pjax' => true]]); ?>
            <?php echo $form->field($listsModel, 'orders_id', ['options' =>['class' => 'hidden']])->textInput(['value' => $model->id]) ?>

            <label for="lists-material_id" class="contpol-label">
                <?php echo Yii::t('app', 'Material'); ?>
            </label>
            <?= AutoComplete::widget([
                'attribute' => 'materials_id',
                'name' => 'Lists[materials_id]',
                'data' =>  $model->partsAutocompleteList(),
                'clientOptions' => [
                    'minChars' => 2,
                ],
            ]) ?>

            <?= $form->field($listsModel, 'qty')->textInput() ?>
            <div class="form-group">
                <?= Html::submitButton($listsModel->isNewRecord ? Yii::t('app', 'Add') : Yii::t('app', 'Update'), ['class' => $listsModel->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        <?php ActiveForm::end(); ?>
    <?php Pjax::end(); ?>
</div>