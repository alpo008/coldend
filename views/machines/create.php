<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Machines */

$this->title = Yii::t('app', 'Create Machines');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Machines'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="machines-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
