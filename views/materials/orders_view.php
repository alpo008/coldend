<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;


?>

<div id="accordion2" class="panel-group">
    <?php $panelTitle = Yii::t('app', 'Orders history'); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion2" href="#collapse2"><?= $panelTitle ?></a>
            </h4>
        </div>
        <div id="collapse2" class="panel-collapse collapse">
            <div class="panel-body">
                <?php

                echo GridView::widget([
                    'dataProvider' => $ordersDataProvider,
                    'showFooter' => true,
                    'columns' => [

                        [
                           'attribute' => 'ref_doc',
                           'value' => function ($ordersDataProvider) {
                                return (Html::a($ordersDataProvider->ref_doc, ['orders/view', 'id' => $ordersDataProvider->id]));
                            },
                            'format' => 'raw',
                        ],
                        'created',
                        'updated',
                        [
                            'attribute' => 'status',
                            'value' => function ($ordersDataProvider) {
                                return $ordersDataProvider->statusesDropdown()[$ordersDataProvider->status];
                            },
                            'format' => 'raw',
                        ],
                        ]]);
                ?>
            </div>
        </div>
    </div>
</div>
