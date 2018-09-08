<?php

namespace app\models;

use \yii\base\Model;

class SignUpForm extends Model
{
    public $username;
    public $password;
    public $email;

    public function rules()
    {
        return [
            [['username', 'password', 'email'], 'required', 'message' => 'Запоните поля'],
            ['username', 'unique', 'targetClass' => User::className(),  'message' => 'Этот логин уже занят'],
            ['email', 'unique', 'targetClass' => User::className(),  'message' => 'Эта почта уже занята'],
            ['email', 'email', 'message' => 'Почта введена в неверном формате']
        ];
    }

    public function attributeLabel()
    {
        return [
            'username' => 'Логин',
            'password' => 'Пароль',
            'email' => 'Почта'
        ];
    }
}