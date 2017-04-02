<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Incoms */

$this->title = Yii::t('app', 'Create Incoms');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Incoms'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="incoms-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
