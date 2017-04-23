<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

?>



        <?php //echo Yii::t('app', 'Components list'); ?>


<?php Pjax::begin(['id' => 'lists-table']) ?>
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
    
            'qty',
            // 'comment:ntext',
    
        ],
    ]); 
    ?>
<?php Pjax::end(); ?>

