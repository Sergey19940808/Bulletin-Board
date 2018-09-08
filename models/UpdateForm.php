<?php

namespace app\models;

use \yii\base\Model;

class UpdateForm extends Model
{
    public $username;
    public $email;

    public function rules()
    {
        return [
            [['username', 'email'], 'required', 'message' => 'Заполните поля'],
            ['username', 'unique', 'targetClass' => User::className(),  'message' => 'Этот логин уже занят'],
            ['email', 'unique', 'targetClass' => User::className(),  'message' => 'Эта почта уже занята'],
            ['email', 'email', 'message' => 'Почта введена в неверном формате']
        ];
    }

}