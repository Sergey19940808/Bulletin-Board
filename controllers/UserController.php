<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 06.09.18
 * Time: 21:43
 */

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\User;


class UserController extends Controller
{
    public function actionIndex()
    {
        $user = User::findIdentity(Yii::$app->user->identity->getId());
        return $this->render('index', [
            'user' => $user
        ]);
    }
}