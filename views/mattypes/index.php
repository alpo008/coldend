<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Materials types');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mattypes-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <?= $this->render('_form',[
        'model' => $model,
    ]) ?>

<?php Pjax::begin(['id' => 'types-table']); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'type_name',

            ['class' => 'yii\grid\ActionColumn',
             'template' => '{delete} {link}',],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
