<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Orders */

$this->title = Yii::t('app', 'Order') . ' No ' .$model->ref_doc . ' ' . Yii::t('app', 'dated') . ' ' . date('Y-m-d', strtotime ($model->created));
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Orders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-view col-lg-6 col-md-6">

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
    <?php
    //var_dump($model->materials[0]->name);
    //var_dump($model->lists[0]->qty);
    //var_dump( date('Y-m-d H:i:s'));
    ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'ref_doc',
            'responsible',
            'created',
            'updated',
            [
                'attribute' => 'status',
                'value' => (array_key_exists($model->status, $model->statusesDropdown())) ? $model->statusesDropdown()[$model->status] : $model->status,
            ],
            'comment:ntext',
        ],
    ]) ?>

</div>
