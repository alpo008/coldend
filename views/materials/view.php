<?php

use yii\helpers\Html;
use yii\widgets\DetailView;


/* @var $this yii\web\View */
/* @var $model app\models\Materials */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Materials'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="materials-view">

    <h1><?= Html::encode($model->name) ?></h1>
    <h2><?= (!!$model->sap) ? Html::encode($model->sap) : Yii::t('app' ,'Sap not defined') ?></h2>

    <div class="row material-cart">
        <div class="col-lg-3">
            <div class="row material-cart__image">
                <?= Html::img($model->photoPath, ['alt' => $model->name,
                    'title' => $model->name,
                    'width' => '200'
                ]);
                ?>
            </div>
            <br />
            
            <div class="row material-cart__doc">
                <?php
                $docfile = $_SERVER['DOCUMENT_ROOT'] . '/docs/' . $model->id . '.pdf';
                $docfile_ = 'docs/' . $model->id . '.pdf';
                if (file_exists($docfile)) {
                    echo '<br />' . Html::a(Yii::t('app', 'Open datasheet'), '@web/docs/' . $model->id . '.pdf', ['target' => '_blank']);
                }
                ?>
            </div>
        </div>

        <div class="col-lg-9 material-cart__attributes">
            <?php echo DetailView::widget([
                'model' => $model,
                'attributes' => [
                    //'id',
                    //'name',
                    'model_ref',
                    'trade_mark',
                    'manufacturer',
                    'generic_usage',
                    'function',
                    //'sap',
                    'type',
                    [
                        'attribute' => 'analog',
                        'value' => (array_key_exists($model->analog, $model->analogsAutocompleteList($model->type))) ? $model->analogsAutocompleteList($model->type)[$model->analog] : null,
                    ],
                    [
                        'attribute' => 'minqty',
                        'value' => (array_key_exists($model->unit, $model->unitsDropdown())) ? $model->minqty . ' ' . $model->unitsDropdown()[$model->unit] : $model->minqty,
                    ],
                    [
                        'attribute' => 'at_stock',
                        'value' => (array_key_exists($model->unit, $model->unitsDropdown())) ? $model->at_stock . ' ' . $model->unitsDropdown()[$model->unit] : $model->at_stock,
                    ],
                    [
                        'attribute' => 'at_dept',
                        'value' => (array_key_exists($model->unit, $model->unitsDropdown())) ? $model->at_dept . ' ' . $model->unitsDropdown()[$model->unit] : $model->at_dept,
                    ],

                    'comment_1',
                    'comment_2:ntext',
                ],
            ])
            ?>
        </div>
    </div>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?php if (!!$model->machines): ?>
    <div id="accordion" class="panel-group">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"><?= Yii::t('app', 'Using in machines'); ?></a>
                </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse">
                <div class="panel-body">
                    <table class="table table-bordered">
                        <?php foreach ($model->machines as $machine): ?>
                        <tr>
                            <td>
                                <?= Html::a($machine->name, ['machines/view', 'id' => $machine->id]); ?>
                            </td>
                            <td>
                                <?= $machine->place; ?>
                            </td>
                            <td>
                                <?php foreach ($model->usages as $usage){
                                    if ($usage->unit_id < 10){
                                        $unitId = 'unit_0' . $usage->unit_id;
                                    }else{
                                    $unitId = 'unit_' . $usage->unit_id;
                                    }
                                    echo $machine->{$unitId} . '&nbsp;' . '|' . '&nbsp;';
                                } ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <?php include 'relations_view.php'; ?>
    <?php if (!!$model->incoms){
        include 'movements_view.php';
    }?>    
    <?php if (!!$model->orders){
        include 'orders_view.php';
    }?>
</div>
