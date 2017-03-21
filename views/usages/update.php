<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Usages */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Usages',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Usages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="usages-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
