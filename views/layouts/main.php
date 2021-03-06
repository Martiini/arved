<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */

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
                'brandLabel' => 'My Company',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => [
                    ['label' => 'Home', 'url' => ['/site/index']],
                    Yii::$app->user->isGuest ?'': [
                        'label' => 'Invoices',
                        'items' => [
                            ['label' => 'List', 'url' => '/invoice'],
                            '<li class="divider"></li>',
                            '<li class="dropdown-header">Actions</li>',
                            ['label' => 'Add invoice', 'url' => '/invoice/create'],
                        ],
                    ],
                    Yii::$app->user->isGuest ?'': [
                        'label' => 'Clients',
                        'items' => [
                            ['label' => 'List', 'url' => '/client'],
                            '<li class="divider"></li>',
                            '<li class="dropdown-header">Actions</li>',
                            ['label' => 'Add client', 'url' => '/client/create'],
                        ],
                    ],
                    Yii::$app->user->isGuest ?'': ['label' => 'Profile', 'url' => ['/user/profile']],
                    Yii::$app->user->isGuest ?'': ['label' => 'Account settings', 'url' => ['/user/account']],

                    Yii::$app->user->isGuest ?
                        ['label' => 'Login', 'url' => ['/user/login']] :
                        ['label' => 'Logout (' . Yii::$app->user->displayName . ')',
                            'url' => ['/user/logout'],
                            'linkOptions' => ['data-method' => 'post']],
                ],
            ]);
            NavBar::end();
        ?>

        <div class="container">
            <?= Breadcrumbs::widget([
                // aww yiss, breadcrumbs :]
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p class="pull-left">&copy; My Company <?= date('Y') ?></p>
            <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
