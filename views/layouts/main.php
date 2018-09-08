<?php

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
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
        'brandLabel' => 'Доска обьявлений',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Объявления', 'url' => ['/bulletin/index']],
            Yii::$app->user->isGuest ? (
                ['label' => 'Войти', 'url' => ['/auth/login']]
            ) : (
                '<li class="link-right">'
                . Html::a('Личный кабинет, '.Yii::$app->user->identity->username, '/user/index')
                . Html::beginForm(['/auth/logout'], 'post')
                . Html::submitButton(
                    'Выйти',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    NavBar::end();
    ?>

    <section class="container">
        <?= Alert::widget() ?>
        <?= $content ?>
    </section>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">
            &copy; Bulletin Board <?= date('Y') ?>
        </p>
        <p class="pull-right">
            Powered by <a href="#">Sergey Alekseev</a>
        </p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
