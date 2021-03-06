<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\MachinesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Machines');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="machines-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Machines'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'id',
            [
                'attribute' => 'name',
                'value' => function ($searchModel) {
                    return ( Html::a(Yii::t('app', $searchModel->name), ['machines/view', 'id' => $searchModel->id]));
                },

                'format' => 'raw',
            ],
            'place',
            [
                'attribute' => 'status',
                'value' => function ($searchModel) {
                        return $searchModel->statusNames()[$searchModel->status];
                },
                'format' => 'raw',
                /**
                 * Отображение фильтра.
                 * Вместо поля для ввода - выпадающий список с заданными значениями directions
                 */
                'filter' => $searchModel->statusNames(),
            ],
            'to_do:ntext',
            // 'to_replace',
            // 'to_order',
            // 'unit_01',
            // 'unit_02',
            // 'unit_03',
            // 'unit_04',
            // 'unit_05',
            // 'unit_06',
            // 'unit_07',
            // 'unit_08',
            // 'unit_09',
            // 'unit_10',
            // 'unit_11',
            // 'unit_12',
            // 'unit_13',
            // 'unit_14',
            // 'unit_15',
            // 'unit_16',
            // 'comment:ntext',

            ['class' => 'app\models\CustomActionColumn',
                'filter' =>     '<a href="/machines"><span class="glyphicon glyphicon-refresh" title="Сбросить фильтр"></span></a>'
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
