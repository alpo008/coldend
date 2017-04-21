<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\OutcomesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Outcomes');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="outcomes-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Outcomes'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],


            [
                'attribute' => 'trans_date',
                'value' => function ($searchModel) {
                    return ( Html::a($searchModel->trans_date,
                        ['outcomes/view', 'id' => $searchModel->id],
                        ['title' => Yii::t('app', 'Outcomes view')])
                    );
                },

                'format' => 'raw',
            ],

            [
                'attribute' => 'materials_id',
                'value' => function ($searchModel) {
                    return ( Html::a(Yii::t('app', $searchModel->partsAutocompleteList()[$searchModel->materials_id]),
                        ['materials/view', 'id' => $searchModel->materials_id],
                        ['title' => Yii::t('app', 'Materials view')])
                    );
                },

                'format' => 'raw',
                'filter' => \anmaslov\autocomplete\AutoComplete::widget(
                    [

                        'attribute' => 'materials_id',
                        'name' => 'OutcomesSearch[materials_id]',
                        'data' => $searchModel->partsAutocompleteList(),
                        'clientOptions' => [
                            'minChars' => 2,
                        ]
                    ])
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
                    return ( Html::a(Yii::t('app', $searchModel->machinesAutocompleteList()[$searchModel->came_to]),
                        ['machines/view', 'id' => $searchModel->came_to],
                        ['title' => Yii::t('app', 'Machines view')])
                    );
                },

                'format' => 'raw',
                'filter' => \anmaslov\autocomplete\AutoComplete::widget(
                    [

                        'attribute' => 'came_to',
                        'name' => 'OutcomesSearch[came_to]',
                        'data' => $searchModel->machinesAutocompleteList(),
                        'clientOptions' => [
                            'minChars' => 2,
                        ]
                    ])
            ],
            // 'responsible',
            [
                'attribute' => 'purpose',
                'value' => function ($searchModel) {
                    return Yii::t('app', $searchModel->purposeDropdown()[$searchModel->purpose]);
                },

                'format' => 'raw',
                'filter' => $searchModel->purposeDropdown(),
            ],
            ['class' => 'app\models\CustomActionColumn',
                //'buttons' => ['update' => function(){return false;}],
                'filter' =>     '<a href="/outcomes"><span class="glyphicon glyphicon-refresh" title="Сбросить фильтр"></span></a>'
            ],
            // 'comment:ntext',
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
