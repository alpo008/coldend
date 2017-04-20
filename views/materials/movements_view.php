<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;


?>

<div id="accordion1" class="panel-group">
    <?php $panelTitle = Yii::t('app', 'Dept stock history'); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion1" href="#collapse1"><?= $panelTitle ?></a>
            </h4>
        </div>
        <div id="collapse1" class="panel-collapse collapse">
            <div class="panel-body">
                <?php
                    $totalCount = 0;
                    foreach ($movementsDataProvider->models as $item){
                        $totalCount += ($item['qty']);
                    }
                echo GridView::widget([
                    'dataProvider' => $movementsDataProvider,
                    'showFooter' => true,
                    'columns' => [

                        [
                           'attribute' => 'trans_date',
                           'value' => function ($movementsDataProvider) {
                               $contrName = ($movementsDataProvider->qty > 0) ? 'incoms' : 'outcomes';
                                return (Html::a($movementsDataProvider->trans_date, [$contrName . '/view', 'id' => $movementsDataProvider->id]));
                            },
                            'footer' => Yii::t('app', 'Dept rest').':',
                            'format' => 'raw',
                        ],
                        [
                            'attribute' => 'qty',
                            'footer' => $totalCount,
                        ],
                        ]]);
                ?>
            </div>
        </div>
    </div>
</div>
