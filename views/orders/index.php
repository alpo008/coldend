<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\OrdersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Orders');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Orders'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'ref_doc',
                'value' => function ($searchModel) {
                    return  Html::a(Yii::t('app', $searchModel->ref_doc), ['orders/view', 'id' => $searchModel->id],['title' => Yii::t('app', 'View order')]);
                },

                'format' => 'raw',
            ],

            'responsible',
            [
                'attribute' => 'created',
                'value' =>  function($searchModel){
                            return $searchModel->datetimeToRus($searchModel->created);
                            },
            ],

            [
                'attribute' => 'updated',
                'value' =>  function($searchModel){
                    return $searchModel->datetimeToRus($searchModel->updated);
                },
            ],

            [
                'attribute' => 'status',
                'value' => function ($searchModel) {
                    return Yii::t('app', $searchModel->statusesDropdown()[$searchModel->status]);
                },

                'format' => 'raw',
                'filter' => $searchModel->statusesDropdown(),
            ],
            // 'comment:ntext',

            ['class' => 'app\models\CustomActionColumn',
                'filter' => '<a href="/orders"><span class="glyphicon glyphicon-refresh" title="Сбросить фильтр"></span></a>'
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
