<?php


/* @var $this yii\web\View */

use app\models\Materials;
use yii\helpers\Html;

$this->title = 'COLD END';

?>
<div class="site-index">
    <div class="text-center">
        <h1><?=Yii::t('app', 'Cold End Electronics')?></h1>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2><?=Yii::t('app', 'Machines')?></h2>
                <?php if(isset($tasksList) && (count($tasksList) > 0)): ?>
                    <div id="accordion-machines" role="tablist" aria-multiselectable="true">
                            <?php foreach ($tasksList as $taskName => $taskData): ?>
                                <?php
                                    $name = ucwords(str_replace('_', ' ', $taskName));
                                    $title = Yii::t('app', $name) . ' (' . count($taskData) . ').';
                                ?>
                                <div class="card">
                                    <div class="card-header" role="tab" id="heading_<?=$taskName?>">
                                        <h5 class="mb-0">
                                            <a data-toggle="collapse" data-parent="#accordion-machines" href="#collapse_<?=$taskName?>" aria-expanded="true" aria-controls="collapse_<?=$taskName?>">
                                                <?=$title?>
                                            </a>
                                        </h5>
                                    </div>

                                    <div id="collapse_<?=$taskName?>" class="collapse" role="tabpanel" aria-labelledby="heading_<?=$taskName?>">
                                        <div class="card-block">
                                            <?php
                                            foreach($taskData as $tData){
                                                $subject = ($taskName === 'to_do') ? $tData->to_do : $tData->m_name;
                                                echo Html::a($tData->place . ' - ' .$tData->name . ' : <br />' . $subject . '<br />', '/machines/update/'.$tData->id );
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                             <?php endforeach;?>
                        </div>
                     </div>
                <?php endif;?>

            <div class="col-lg-4">
                <h2><?=Yii::t('app', 'Stock')?></h2>
                <?php if(isset($stockStatus) && (count($stockStatus) > 0)): ?>
                    <div id="accordion-stock" role="tablist" aria-multiselectable="true">
                        <?php foreach ($stockStatus as $stockName => $stockData): ?>
                            <?php
                            $name = ucwords(str_replace('_', ' ', $stockName));
                            $title = Yii::t('app', $name) . ' (' . count($stockData) . ').';
                            ?>
                            <div class="card">
                                <div class="card-header" role="tab" id="heading_<?=$stockName?>">
                                    <h5 class="mb-0">
                                        <a data-toggle="collapse" data-parent="#accordion-stock" href="#collapse_<?=$stockName?>" aria-expanded="true" aria-controls="collapse_<?=$stockName?>">
                                            <?=$title?>
                                        </a>
                                    </h5>
                                </div>

                                <div id="collapse_<?=$stockName?>" class="collapse" role="tabpanel" aria-labelledby="heading_<?=$stockName?>">
                                    <div class="card-block">
                                        <?php
                                        foreach($stockData as $sData){
                                            $subject = ($stockName === 'total_count_less_than_limit') ? Yii::t('app', 'rest') . ' : ' . ($sData->at_stock + $sData->at_dept) : '';
                                            echo Html::a($sData->name . ' : <br />' . Yii::t('app', 'Minimal qty'). ' - ' .$sData->minqty . ' , ' . $subject, '/materials/view/'.$sData->id );
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach;?>
                    </div>
                <?php endif;?>
            </div>


            <div class="col-lg-4">
                <h2><?=Yii::t('app', 'Orders')?></h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>
            </div>
        </div>
    </div>
</div>

