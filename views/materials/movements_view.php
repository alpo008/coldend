<?php
use anmaslov\autocomplete\AutoComplete;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;


?>

<div id="accordion1" class="panel-group">
    <?php $panelTitle = Yii::t('app', 'Stocks history'); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion1" href="#collapse1"><?= $panelTitle ?></a>
            </h4>
        </div>
        <div id="collapse1" class="panel-collapse collapse">
            <div class="panel-body">
                <?php foreach ($model->incoms as $incom):
                    echo $incom->trans_date. '<br />';
                endforeach; ?>

            </div>
        </div>
    </div>
</div>
