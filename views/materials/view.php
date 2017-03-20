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
                <?php
                $imagefile = '@web/photos/' . $model->id . '.jpg';
                $imagefile = (file_exists($_SERVER['DOCUMENT_ROOT'] . '/photos/' . $model->id . '.jpg')) ? $imagefile : '@web/photos/_no-image.jpg';
                echo Html::img($imagefile, ['alt' => $model->name,
                    'title' => $model->name,
                    'width' => '200'
                ]);
                ?>
            </div>
            
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
                    'id',
                    'name',
                    'model_ref',
                    'trade_mark',
                    'manufacturer',
                    'generic_usage',
                    'function',
                    'sap',
                    'type',
                    [
                        'attribute' => 'analog',
                        'value' => (array_key_exists($model->analog, $model->analogsAutocompleteList($model->type))) ? $model->analogsAutocompleteList($model->type)[$model->analog] : null,
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


</div>
