<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use app\models\LoginForm;
use app\models\SignUpForm;
use app\models\User;

class AuthController extends Controller
{

    public function actionSignUp()
    {
        if (!Yii::$app->user->isGuest ) {
            return $this->goHome();
        }

        $model = new SignUpForm();

        if($model->load(Yii::$app->request->post()) && $model->validate()){
            $user = new User();
            $user->username = $model->username;
            $user->password = Yii::$app->security->generatePasswordHash($model->password);
            $user->email = $model->email;
            echo $model->username;
            if($user->save()){
                return $this->goHome();
            }
        }

        return $this->render('signup', ['model' => $model]);
    }


    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', ['model' => $model]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}