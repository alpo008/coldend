<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\IncomsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Materials incoms');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="incoms-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Incoms'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                'attribute' => 'materials_id',
                'value' => function ($searchModel) {
                    return ( Html::a(Yii::t('app', $searchModel->partsAutocompleteList()[$searchModel->materials_id]), ['materials/view', 'id' => $searchModel->id]));
                },

                'format' => 'raw',
            ],
            'qty',
            [
                'attribute' => 'came_from',
                'value' => function ($searchModel) {
                    return Yii::t('app', $searchModel->fromDropdown()[$searchModel->came_from]);
                },

                'format' => 'raw',
                'filter' => $searchModel->fromDropdown(),
            ],
            [
                'attribute' => 'came_to',
                'value' => function ($searchModel) {
                    return Yii::t('app', $searchModel->toDropdown()[$searchModel->came_to]);
                },

                'format' => 'raw',
                'filter' => $searchModel->toDropdown(),
            ],
            'responsible',
            'trans_date',
            'ref_doc',
            // 'comment:ntext',

            ['class' => 'app\models\CustomActionColumn',
                'buttons' => ['update' => function(){return false;}],
                'filter' =>     '<a href="/incoms"><span class="glyphicon glyphicon-refresh" title="Сбросить фильтр"></span></a>'
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
