<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\LinkPager;

$this->title = 'Bullitin Board';
?>
<aside class="bullitin-board">
    <div class="list">
        <?php foreach ($bulletins as $bulletin): ?>
            <div class="list-item">
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

    <?= LinkPager::widget(['pagination' => $pagination]) ?>

</aside>
