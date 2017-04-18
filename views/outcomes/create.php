<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Outcomes */

$this->title = Yii::t('app', 'Create Outcomes');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Outcomes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="outcomes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
