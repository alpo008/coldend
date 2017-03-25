<?php
use anmaslov\autocomplete\AutoComplete;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;


$this->registerJs(
    '$("document").ready(function(){
        $("#accordion").find("a").on("click", function(){
        $(".display-block").toggleClass("display-block");
        });
    
        $("#usages-form_01").on("pjax:end", function() {
        $.pjax.reload({container:"#usages-table_01",timeout:1000});
        $(this).parent().toggleClass("display-block");
        });            
        $("#usages-form_02").on("pjax:end", function() {
            $.pjax.reload({container:"#usages-table_02",timeout:1000});
            $(this).parent().toggleClass("display-block");
        });            
        $("#usages-form_03").on("pjax:end", function() {
            $.pjax.reload({container:"#usages-table_03",timeout:1000});
            $(this).parent().toggleClass("display-block");
        });            
        $("#usages-form_04").on("pjax:end", function() {
            $.pjax.reload({container:"#usages-table_04",timeout:1000});
            $(this).parent().toggleClass("display-block");
        });            
        $("#usages-form_05").on("pjax:end", function() {
            $.pjax.reload({container:"#usages-table_05",timeout:1000});
            $(this).parent().toggleClass("display-block");
        });            
        $("#usages-form_06").on("pjax:end", function() {
            $.pjax.reload({container:"#usages-table_06",timeout:1000});
            $(this).parent().toggleClass("display-block");
        });            
        $("#usages-form_07").on("pjax:end", function() {
            $.pjax.reload({container:"#usages-table_07",timeout:1000});
            $(this).parent().toggleClass("display-block");
        });            
        $("#usages-form_08").on("pjax:end", function() {
            $.pjax.reload({container:"#usages-table_08",timeout:1000});
            $(this).parent().toggleClass("display-block");
        });            
        $("#usages-form_09").on("pjax:end", function() {
            $.pjax.reload({container:"#usages-table_09",timeout:1000});
            $(this).parent().toggleClass("display-block");
        });            
        $("#usages-form_10").on("pjax:end", function() {
            $.pjax.reload({container:"#usages-table_10",timeout:1000});
            $(this).parent().toggleClass("display-block");
        });            
        $("#usages-form_11").on("pjax:end", function() {
            $.pjax.reload({container:"#usages-table_11",timeout:1000});
            $(this).parent().toggleClass("display-block");
        });            
        $("#usages-form_12").on("pjax:end", function() {
            $.pjax.reload({container:"#usages-table_12",timeout:1000});
            $(this).parent().toggleClass("display-block");
        });            
        $("#usages-form_13").on("pjax:end", function() {
            $.pjax.reload({container:"#usages-table_13",timeout:1000});
            $(this).parent().toggleClass("display-block");
        });            
        $("#usages-form_14").on("pjax:end", function() {
            $.pjax.reload({container:"#usages-table_14",timeout:1000});
            $(this).parent().toggleClass("display-block");
        });            
        $("#usages-form_15").on("pjax:end", function() {
            $.pjax.reload({container:"#usages-table_15",timeout:1000});
            $(this).parent().toggleClass("display-block");
        });        
        $("#usages-form_16").on("pjax:end", function() {
            $.pjax.reload({container:"#usages-table_16",timeout:1000});
            $(this).parent().toggleClass("display-block");
        });
    });'
);
?>

<div id="accordion" class="panel-group">
    <?php for ($i = 1; $i < 17; $i++):?>
        <?php
        $i = ($i < 10) ? '0' . $i : $i;
        $unitId = 'unit_' . $i;

        ?>
        <?php if ((!!$model->{$unitId})): ?>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="<?= '#collapse'. $i; ?>"><?= $i . '. ' . $model->{$unitId}; ?></a>
                    </h4>
                </div>
                <div id="<?= 'collapse'. $i; ?>" class="panel-collapse collapse">
                    <div class="panel-body">
                        <?php $unitModel = $existingUsages->filterWhere(['unit_id' => $i]);?>
                        <?php Pjax::begin(['id' => 'usages-table_'.$i]) ?>
                        <?= GridView::widget([
                            'dataProvider' => new \yii\data\ActiveDataProvider([
                                'query' => $unitModel,
                            ]),
                            'summary' => false,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],
                                [
                                    'attribute' => 'materials_id',
                                    'value' => function ($unitModel) use($usagesModel) {
                                        $str = $usagesModel->partsAutocompleteList()[$unitModel->materials_id];
                                        $arr = explode (';', $str);
                                        return $arr[1] . ';' . $arr[2];
                                    },

                                ],
                                'unit_qty',
                            ],
                        ]) ?>
                        <?php Pjax::end(); ?>

                        <span class="glyphicon glyphicon-plus-sign form-opener"></span>
                        <?php $usagesModel->unit_id = $i;
                        $usagesModel->machines_id = $model->id;
                        ?>
                        <div class="create-form">
                            <?php Pjax::begin(['id' => 'usages-form_'.$i]); ?>
                            <?php $form = ActiveForm::begin(['options' => ['data-pjax' => true]]); ?>

                            <?php echo $form->field($usagesModel, 'machines_id')->textInput(['class' => 'hidden'])->label('', ['class' => 'hidden']) ?>

                            <?php echo $form->field($usagesModel, 'unit_id')->textInput(['class' => 'hidden'])->label('', ['class' => 'hidden']) ?>
                            <label for="usages-material_id" class="contpol-label">
                                <?php echo Yii::t('app', 'Material'); ?>
                            </label>
                            <?= AutoComplete::widget([
                                'attribute' => 'materials_id',
                                'name' => 'Usages[materials_id]',
                                'data' =>  $usagesModel->partsAutocompleteList(),
                                'clientOptions' => [
                                    'minChars' => 2,
                                ],
                            ]) ?>

                            <?= $form->field($usagesModel, 'unit_qty')->textInput() ?>
                            <div class="form-group">
                                <?= Html::submitButton($usagesModel->isNewRecord ? Yii::t('app', 'Add') : Yii::t('app', 'Update'), ['class' => $usagesModel->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                            </div>
                            <?php ActiveForm::end(); ?>
                            <?php Pjax::end(); ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endfor;?>
</div>
