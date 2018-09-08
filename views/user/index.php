<?php
use yii\helpers\Html;

$this->title = 'Личный кабинет';
?>

<aside class="personal-area">
    <div class="data-one">
        <div class=<?= Html::encode($user->avatar === null ? 'hide' : 'avatar') ?>>
            <img src=<?= Html::encode($path.$user->avatar)?> width="150" height="150" />
        </div>
        <div class=<?= Html::encode($user->avatar === null ? 'show' : 'hide') ?>>
            <i>
                Добавьте аватар
            </i>
        </div>
        <div class="title">
            <div class="title__username">
                <?= Html::encode($user->username) ?>
            </div>
            <div class="title__email">
                <?= Html::encode($user->email) ?>
            </div>
            <?= Html::a('Изменить имя и почту', '/user/update', ['class' => 'link-title']) ?>
        </div>
    </div>
    <div class="content">
        <?= Html::a('Изменить аватар', '/user/upload', ['class' => 'link-image']) ?>
        <h3>
            Ваши объявления
        </h3>
        <div class="list">
            <?php foreach ($bulletins as $bulletin): ?>
                <div class="list-item">
                    <?= Html::a('Изменить', '/user/update-bulletin/'.$bulletin->id, ['class' => 'link-bulletin']) ?>
                    <header class="list-item__header">
                        <?= Html::encode("{$bulletin->title}") ?>
                    </header>
                    <p class="list-item__content">
                        <?= Html::encode("{$bulletin->content}") ?>
                    </p>
                    <p class="list-item__date-add">
                        <i>
                            <?= Html::encode("{$bulletin->date_add}") ?>
                        </i>
                    </p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</aside>
