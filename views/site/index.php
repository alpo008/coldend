<?php


/* @var $this yii\web\View */

$this->title = 'COLD END';

?>
<div class="site-index">

    <div class="jumbotron">
        <h1><?=Yii::t('app', 'Cold End Electronics')?></h1>

    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2><?=Yii::t('app', 'Machines')?></h2>

                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

            </div>
            <div class="col-lg-4">
                <h2><?=Yii::t('app', 'Stock')?></h2>

                <p> <?= Yii::t('app', 'Total q-ty at stocks is zero') . ': ' . $zeroAtStock . ' ' . Yii::t('app', 'items')?> </p>

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
