<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Обновление объявления';
?>

<?php $form = ActiveForm::begin() ?>
<?= $form->field($model, 'title')->textInput(['value' => Html::encode($bulletin->title)]) ?>
<?= $form->field($model, 'content')->textInput(['value' => Html::encode($bulletin->content)]) ?>
<?= $form->field($model, 'date_add')->textInput(['value' => Html::encode($bulletin->date_add)]) ?>

    <div class="form-group">
        <div>
            <?= Html::submitButton('Обновить', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
<?php ActiveForm::end() ?>