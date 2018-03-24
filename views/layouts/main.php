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
        'brandLabel' => Yii::t('app', 'HOME'),
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => (Yii::t('app', 'MACHINES')), 'url' => ['/machines']],
            ['label' => (Yii::t('app', 'MATERIALS')), 'url' => ['/materials']],
            [
                'label' => (Yii::t('app', 'OPERATIONS')),
                'items' => [

                    ['label' => Yii::t('app', 'Materials incoms'), 'url' => ['/incoms'] ],
                    ['label' => Yii::t('app', 'Materials outlays'), 'url' => ['/outcomes'] ],
                    ['label' => Yii::t('app', 'Orders'), 'url' => ['/orders'] ],
                ],
            ],
            [
                'label' => (Yii::t('app', 'OPTIONS')),
                'items' => [
                    ['label' => Yii::t('app', 'Materials types'), 'url' => '/mattypes'],
                    ['label' => Yii::t('app', 'Users'), 'url' => '/user',
                        'options' => [
                            'class' => (Yii::$app->user->identity['role'] != 'ADMIN' && Yii::$app->user->identity['role'] != 'ENGINEER') ? 'hidden' : '',
                        ]
                    ],

                ],
            ],
            Yii::$app->user->isGuest ? (
                ['label' => (Yii::t('app', 'LOGIN')), 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    (Yii::t('app', 'LOGOUT')) . ' (' . Yii::$app->user->identity->surname . ')',
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
