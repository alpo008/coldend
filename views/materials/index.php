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
            [
                'attribute' => 'name',
                'value' => function ($searchModel) {
                    $filename = (is_file('../web/photos/' . $searchModel->id . '.jpg')) ? '@web/photos/' . $searchModel->id . '.jpg' : '@web/photos/_no-image.jpg';
                    return ( Html::a(Yii::t('app', $searchModel->name), ['materials/view', 'id' => $searchModel->id], ['data-content' => Html::img($filename)]) .
                    Html::img($filename, ['class' => 'thumb', 'style' => 'z-index: 4;']));
                },

                'format' => 'raw',
            ],

            'model_ref',
            //'trade_mark',
            'manufacturer',
            //'generic_usage',
            // 'function',
            'sap',
/*            [
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
            ],*/
            'minqty',
            [
                'attribute' => 'unit',
                'value' => function ($searchModel) {
                    return $searchModel->unitsDropdown()[$searchModel->unit];
                },

                'filter' => $searchModel->unitsDropdown(),
            ],

            'at_stock',
            'at_dept',
            [
                'attribute' => 'type',
                /**
                 * Отображение фильтра.
                 * Вместо поля для ввода - выпадающий список с заданными значениями directions
                 */
                'filter' => $searchModel->typesDropdown(),
            ],
            // 'comment_1',
            // 'comment_2:ntext',

            [
                'label' => '',
                'format' => 'raw',
                'value' => function($model){
                    return Html::a('<span class ="glyphicon glyphicon-import" title ="Создать запись о приходе"></span>', ['incoms/create', 'id' => $model->id ])
                    . '<br /><br />'
                    . Html::a('<span class ="glyphicon glyphicon-export" title ="Создать запись о расходе"></span>', ['outcomes/create', 'id' => $model->id], ['class' => ($model->at_stock + $model->at_dept == 0) ? 'hidden' : '' ]);

                },
            ],

            ['class' => 'app\models\CustomActionColumn',
                'filter' =>     '<a href="/materials"><span class="glyphicon glyphicon-refresh" title="Сбросить фильтр"></span></a>'
            ],
        ],
    ]); ?>

<?php Pjax::end(); ?></div>
<?php if ($message = Yii::$app->session->getFlash('material_delete_error')){
    echo "<script>alert('$message');</script>";
}
?>
