<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

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

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'place',
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
            'unit_01',
            'unit_02',
            'unit_03',
            'unit_04',
            'unit_05',
            'unit_06',
            'unit_07',
            'unit_08',
            'unit_09',
            'unit_10',
            'unit_11',
            'unit_12',
            'comment:ntext',
        ],
    ]) ?>

</div>
