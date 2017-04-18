<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Outcomes */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Outcomes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="outcomes-view">

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
            //'id',
            [
                'attribute' => 'materials_id',
                'value' => (array_key_exists($model->materials_id, $model->partsAutocompleteList())) ? $model->partsAutocompleteList()[$model->materials_id] : $model->materials_id,
            ],
            'qty',
            [
                'attribute' => 'came_from',
                'value' => (array_key_exists($model->came_from, $model->fromDropdown())) ? $model->fromDropdown()[$model->came_from] : $model->came_from,
            ],
            [
                'attribute' => 'came_to',
                'value' => (array_key_exists($model->came_to, $model->machinesAutocompleteList())) ? $model->machinesAutocompleteList()[$model->came_to] : $model->came_to,
            ],
            'responsible',
            'trans_date',
            'purpose',
            'comment:ntext',
        ],
    ]) ?>

</div>
