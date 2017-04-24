<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

?>

<?php Pjax::begin(['id' => 'lists-table']); ?>
    <?= GridView::widget([
        'dataProvider' => $listsDataProvider,
        'summary' => false,
    
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
    
            [
                'attribute' => 'materials_id',
                'value' => function ($listsDataProvider) use ($model) {
                    return (array_key_exists($listsDataProvider->materials_id, $model->partsAutocompleteList())) ?
                        Html::a(Yii::t('app', $model->partsAutocompleteList()[$listsDataProvider->materials_id]),
                            ['materials/view', 'id' => $listsDataProvider->materials_id],
                            ['title' => Yii::t('app', 'Materials view')]
                        ) :
                        NULL;
                },
    
                'format' => 'raw',
            ],

            [
                'attribute' => 'qty',
                'value' => function ($listsDataProvider) use ($editable)  {
                    return ($editable) ?
                        Html::input('text', 'qty', $listsDataProvider->qty, ['class' => 'lists-qty']) .
                        Html::tag('span', '', ['class' => 'glyphicon glyphicon-pencil lists-edit', 'id' => $listsDataProvider->materials_id . '_e']) .
                        Html::tag('span', '', ['class' => 'glyphicon glyphicon-trash lists-delete', 'id' => $listsDataProvider->materials_id . '_d']) .
                        Html::tag('div', $listsDataProvider->qty, ['class' => 'old-qty hidden'])
                        : $listsDataProvider->qty;
                },
                'format' => 'raw',
            ],
        ],
    ]); 
    ?>
<?php Pjax::end(); ?>

