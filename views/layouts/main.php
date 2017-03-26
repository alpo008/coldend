<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'COLDEND',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => mb_strtoupper(Yii::t('app', 'Home')), 'url' => ['/site/index']],
            ['label' => mb_strtoupper(Yii::t('app', 'Machines')), 'url' => ['/machines']],
            ['label' => mb_strtoupper(Yii::t('app', 'Materials')), 'url' => ['/materials']],
            [
                'label' => mb_strtoupper(Yii::t('app', 'Options')),
                'items' => [
                    ['label' => Yii::t('app', 'Materials types'), 'url' => '/mattypes'],
                    ['label' => '---', 'url' => '#'],

                ],
            ],
            Yii::$app->user->isGuest ? (
                ['label' => mb_strtoupper(Yii::t('app', 'Login')), 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    mb_strtoupper(Yii::t('app', 'Logout')) . ' (' . Yii::$app->user->identity->surname . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Ruscam-UFA 2017</p>

        <p class="pull-right"><a href="mailto:alexey.pozhidaev.ext@hotmail.com?subject=RUSCAM MYSQL">github.com/alpo008</a></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
