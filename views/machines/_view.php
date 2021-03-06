<?php

use anmaslov\autocomplete\AutoComplete;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\models\Machines */

$this->title = $model->name . ' - ' . $model->place;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Machines'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="machines-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="row">
        <div class="col-lg-6 col-md-6">

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    //'name',
                    //'place',
                    [
                        'attribute' => 'status',
                        'value' => $model->statusNames()[$model->status],
                    ],
                    'to_do:ntext',
                    [
                        'attribute' => 'to_order',
                        'value' => (array_key_exists($model->to_order, $model->partsAutocompleteList())) ? $model->partsAutocompleteList()[$model->to_order] : null,
                    ],
                    [
                        'attribute' => 'to_replace',
                        'value' => (array_key_exists($model->to_replace, $model->partsAutocompleteList())) ? $model->partsAutocompleteList()[$model->to_replace] : null,
                    ],
                ],
            ]) ?>


            <div class="panel panel-default">
                <div class="panel-heading"><?= $model->attributeLabels()['comment'].':'; ?></div>
                <div class="panel-body">
                    <?= $model->comment; ?>
                </div>
            </div>
        </div>

        <div class="col-lg-1 col-md-1"></div>

        <div class="col-lg-5 col-md-5">
            <div id="accordion" class="panel-group">
                <?php for ($i = 1; $i < 17; $i++):?>
                    <?php
                    $i = ($i < 10) ? '0' . $i : $i;
                    $unitId = 'unit_' . $i;
                    ?>
                    <?php if ((!!$model->{$unitId})): ?>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="<?= '#collapse'. $i; ?>"><?= $i . '. ' . $model->{$unitId}; ?></a>
                                </h4>
                            </div>
                            <div id="<?= 'collapse'. $i; ?>" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <table class="table table-bordered">
                                        <?php foreach ($model->getUnitUsages($model->id, $i) as $part): ?>
                                            <tr>
                                                <td>
                                                    <?=$part['materials']['name']; ?>
                                                </td>
                                                <td>
                                                    <a href="<?= '/materials/' . $part['materials_id'];?>"><?=$part['materials']['model_ref']; ?></a>
                                                </td>
                                                <td>
                                                    <?=$part['unit_qty'] . '--'. $part['id']; ?>
                                                </td>
                                                <td>
                                                    <?= Html::a('<span class="glyphicon glyphicon-trash"></span>', ['usages/delete', 'id' => $part['id']]);?>
                                                </td>
                                                <td>
                                                    <?= Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['usages/update', 'id' => $part['id']]);?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </table>
                                    <span class="glyphicon glyphicon-plus-sign form-opener"></span>
                                    <?php $usagesModel->unit_id = $i;
                                    $usagesModel->machines_id = $model->id;
                                    ?>
                                    <div class="create-form">
                                        <?php Pjax::begin(); ?>
                                        <?php $form = ActiveForm::begin(['action' => '/usages/create', 'options' => ['data-pjax' => true]]); ?>

                                        <?php echo $form->field($usagesModel, 'machines_id')->textInput(['class' => 'hidden'])->label('', ['class' => 'hidden']) ?>

                                        <?php echo $form->field($usagesModel, 'unit_id')->textInput(['class' => 'hidden'])->label('', ['class' => 'hidden']) ?>
                                        <label for="usages-material_id" class="contpol-label">
                                            <?php echo Yii::t('app', 'Material'); ?>
                                        </label>
                                        <?= AutoComplete::widget([
                                            'attribute' => 'materials_id',
                                            'name' => 'Usages[materials_id]',
                                            'data' =>  $usagesModel->partsAutocompleteList(),
                                            'clientOptions' => [
                                                'minChars' => 2,
                                            ],
                                        ]) ?>

                                        <?= $form->field($usagesModel, 'unit_qty')->textInput() ?>
                                        <div class="form-group">
                                            <?= Html::submitButton($usagesModel->isNewRecord ? Yii::t('app', 'Add') : Yii::t('app', 'Update'), ['class' => $usagesModel->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                                        </div>
                                        <?php ActiveForm::end(); ?>
                                        <?php Pjax::end(); ?>
                                    </div>
                                
                                
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endfor;?>
            </div>
        </div>
    </div>
</div>
