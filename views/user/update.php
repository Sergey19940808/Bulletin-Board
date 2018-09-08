<?php
    use yii\helpers\Html;
    use yii\bootstrap\ActiveForm;

    $this->title = 'Обновление личных данных';
?>

<?php $form = ActiveForm::begin() ?>
<?= $form->field($model, 'username')->textInput(['value' => Html::encode($user->username)]) ?>
<?= $form->field($model, 'email')->textInput(['value' => Html::encode($user->email)]) ?>
<div class="form-group">
    <div>
        <?= Html::submitButton('Обновить', ['class' => 'btn btn-primary']) ?>
    </div>
</div>
<?php ActiveForm::end() ?>
