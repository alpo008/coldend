<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\MaterialsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Materials');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="materials-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Materials'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'name',
            'model_ref',
            //'trade_mark',
            'manufacturer',
            //'generic_usage',
            // 'function',
            'sap',
            [
                'attribute' => 'analog',
                'value' => function ($searchModel) {
                    if (!!($searchModel->analog)){
                        $result = (array_key_exists($searchModel->analog, $searchModel->analogsAutocompleteList($searchModel->type))) ? $searchModel->analogsAutocompleteList($searchModel->type)[$searchModel->analog] : null;
                        $result = (is_string($result)) ? explode(';', $result) :null;
                        $result = (is_array($result)) ? trim($result[2]) : null;
                        return (!!$result) ? Html::a(Yii::t('app', $result), ['materials/view', 'id' => $searchModel->analog]) : null;
                    }else{
                        return NULL;
                    }
                },

                'format' => 'raw',
            ],
            'minqty',
            'type',
            // 'comment_1',
            // 'comment_2:ntext',

            ['class' => 'app\models\CustomActionColumn',
                'filter' =>     '<a href="/user"><span class="glyphicon glyphicon-refresh" title="Сбросить фильтр"></span></a>'
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
