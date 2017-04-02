<?php
use anmaslov\autocomplete\AutoComplete;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;


$this->registerJs(
    '$("document").ready(function(){
        $("#accordion").find("a").on("click", function(){
        $(".display-block").removeClass("display-block");
        });
    
        $("#relations-form").on("pjax:end", function() {
        $.pjax.reload({container:"#relations-table",timeout:1000});
        $(this).parent().removeClass("display-block");
        });            
    });'
);
?>

<div id="accordion" class="panel-group">
    <?php $panelTitle = Yii::t('app', 'Materials related to this one'); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse"><?= $panelTitle ?></a>
            </h4>
        </div>
        <div id="collapse" class="panel-collapse collapse">
            <div class="panel-body">
                <?php
                $relation = $relationsModel->partType;
                $relationsQuery = ($relation == 'parent')? $model->getChildren() : $model->getParents();
                $attributeName = ($relation == 'parent')? 'child_id' : 'parent_id';
                $parentInputClassName = ($relation == 'parent')? 'hidden' : NULL;
                $childInputClassName = ($relation == 'child')? 'hidden' : NULL;
                $radioInputClassName = ($relation != NULL)? 'hidden' : NULL;

                ?>
                <?php Pjax::begin(['id' => 'relations-table']) ?>
                <?= GridView::widget([
                    'dataProvider' => new \yii\data\ActiveDataProvider([
                        'query' => $relationsQuery,
                    ]),
                    'summary' => false,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        [
                            'attribute' => $attributeName,
                            'value' => function ($existingRelations) use($model, $attributeName) {
                                $str = $model->partsAutocompleteList()[$existingRelations->{$attributeName}];
                                     return Html::a($str, ['/materials/view', 'id' => $existingRelations->{$attributeName}], ['data-pjax'=> '0']);
                            },
                            'format' => 'raw',
                        ],

                        [
                            'label' => '',
                            'value' => function($existingRelations){
                                return Html::tag('span', '', ['class' => 'glyphicon glyphicon-trash relations-delete']);
                            },
                            'format' => 'raw',
                        ],
                    ],
                ]) ?>
                <?php Pjax::end(); ?>

                <span class="glyphicon glyphicon-plus-sign form-opener"></span>

                <div class="create-form">
                    <?php Pjax::begin(['id' => 'relations-form']); ?>
                    <?php $form = ActiveForm::begin(['options' => ['data-pjax' => true]]); ?>
                    <div class="unit-id hidden"><?=$model->id?></div>
                    <div class = <?= $radioInputClassName?>>
                        <?= $form->field($relationsModel, 'partType')->radioList($relationsModel->partTypes() ); ?>
                    </div>

                    <div class = <?= $parentInputClassName?>>
                        <label for="relations-parent_id" class="contpol-label">
                            <?php echo Yii::t('app', 'Parent ID'); ?>
                        </label>
                        <?= AutoComplete::widget([
                            'attribute' => 'parent_id',
                            'name' => 'Relations[parent_id]',
                            'data' => $relationsModel->partsAutocompleteList(),
                            'value' => ($relation == 'parent') ? $model->id : NULL,
                            'clientOptions' => [
                                'minChars' => 2,
                            ],
                        ]) ?>
                    </div>

                    <div class = <?= $childInputClassName?>>
                        <label for="relations-child_id" class="contpol-label">
                            <?php echo Yii::t('app', 'Child ID'); ?>
                        </label>
                        <?= AutoComplete::widget([
                            'attribute' => 'child_id',
                            'name' => 'Relations[child_id]',
                            'data' => $relationsModel->partsAutocompleteList(),
                            'value' => ($relation == 'child') ? $model->id : NULL,
                            'clientOptions' => [
                                'minChars' => 2,
                            ],
                        ]) ?>
                    </div>
                    <br />
                    <div class="form-group">
                        <?= Html::submitButton($relationsModel->isNewRecord ? Yii::t('app', 'Add') : Yii::t('app', 'Update'), ['class' => $relationsModel->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                    </div>
                    <?php ActiveForm::end(); ?>
                    <?php Pjax::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
