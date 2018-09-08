<?php

namespace app\models;

use \yii\base\Model;

class UpdateBulletinForm extends Model
{
    public $title;
    public $content;
    public $date_add;

    public function rules()
    {
        return [
            [['title', 'content', 'date_add'], 'required', 'message' => 'Заполните поля'],
        ];
    }
}