<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use app\models\User;

$this->title = 'Личный кабинет';
$user_session = Yii::$app->user->isGuest ? null : User::findIdentity(Yii::$app->user->identity->getId());
?>

<aside class="personal-area">
    <div class="data-one">
        <div class=<?= $user->avatar === null ? 'hide' : 'avatar' ?>>
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

            <a href="<?= Url::to(['user/update', 'id' => $user->id]) ?>"
               class=<?= Html::encode($user->id === $user_session->id ? 'link-title show' : 'hide') ?>
            >
                Изменить имя и почту
            </a>
        </div>
    </div>
    <div class="content">
        <a href="<?= Url::to(['user/upload', 'id' => $user->id]) ?>"
           class=<?= Html::encode($user->id === $user_session->id ? 'link-image show' : 'hide') ?>
        >
            Изменить аватар
        </a>
        <h3>
            Ваши объявления
        </h3>
        <div class="bulletins">
            <a href="<?= Url::to(['index', 'is_bulletins' => true, 'id' => $user->id]) ?>"
               class="link-bulletin"
            >
                Все объявления
            </a>
        </div>
        <div class="list">
            <?php foreach ($bulletins as $bulletin): ?>
                <div class="list-item">
                    <a href="<?= Url::to(['user/update-bulletin', 'id' => $bulletin->id]) ?>"
                       class=<?= Html::encode($user->id === $user_session->id ? 'link-bulletin show' : 'hide') ?>
                    >
                        Изменить
                    </a>
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
                        <span>
                            <a href="<?= Url::to(['user/index', 'id' => $bulletin->user_id]) ?>" class="link-bulletin">
                                Пользователь
                            </a>
                        </span>
                    </p>
                </div>
            <?php endforeach; ?>
        </div>

        <?= LinkPager::widget(['pagination' => $pagination]) ?>

    </div>
</aside>
