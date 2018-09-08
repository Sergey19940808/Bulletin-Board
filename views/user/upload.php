<?php
use yii\widgets\ActiveForm;

$this->title = 'Обновление аватара';
?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

<?= $form->field($model, 'file')->fileInput() ?>

    <button>Добавить</button>

<?php ActiveForm::end() ?>