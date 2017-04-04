<?php


use yii\helpers\Html;
use yii\widgets\DetailView;


/* @var $this yii\web\View */
/* @var $model app\models\Machines */

$this->title = $model->name . ' - ' . $model->place;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Machines'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="machines-view">

    <h1><?= Html::encode($this->title) ?></h1>

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

    <div class="row">
        <div class="col-lg-5 col-md-5">

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    //'name',
                    //'place',
                    [
                        'attribute' => 'status',
                        'value' => $model->statusNames()[$model->status],
                    ],
                    'to_do:ntext',
                    [
                        'attribute' => 'to_order',
                        'value' => (array_key_exists($model->to_order, $model->partsAutocompleteList())) ? $model->partsAutocompleteList()[$model->to_order] : null,
                    ],
                    [
                        'attribute' => 'to_replace',
                        'value' => (array_key_exists($model->to_replace, $model->partsAutocompleteList())) ? $model->partsAutocompleteList()[$model->to_replace] : null,
                    ],
                ],
            ]) ?>

                <div class="machine-cart__image">
                    <?php
                    $imagefile = '@web/photos_/' . $model->id . '.jpg';
                    $imagefile = (file_exists($_SERVER['DOCUMENT_ROOT'] . '/photos_/' . $model->id . '.jpg')) ? $imagefile : '@web/photos/_no-image.jpg';
                        echo '<br />' . Html::a(Html::img($imagefile, ['alt' => $model->name,
                                'title' => Yii::t('app', 'See schema'),
                                'width' => '200',
                            ]), '@web/photos_/' . $model->id . '.jpg', ['target' => '_blank']);
                    ?>
                </div>
                <br/>

                <div class="machine-cart__schema">
                    <?php
                    $docfile = $_SERVER['DOCUMENT_ROOT'] . '/schemas/' . $model->id . '.pdf';
                    $docfile_ = 'schemas/' . $model->id . '.pdf';
                    if (file_exists($docfile)) {
                        echo '<br />' . Html::a(Yii::t('app', 'Open datasheet'), '@web/schemas/' . $model->id . '.pdf', ['target' => '_blank']);
                    }
                    ?>
                </div>
            <br /><br />

            <div class="panel panel-default">
                <div class="panel-heading"><?= $model->attributeLabels()['comment'].':'; ?></div>
                <div class="panel-body">
                    <?= $model->comment; ?>
                </div>
            </div>
        </div>

        <div class="col-lg-1 col-md-1"></div>

        <div class="col-lg-6 col-md-6">
            <?php include 'usages_view.php'; ?>
        </div>
    </div>
</div>
