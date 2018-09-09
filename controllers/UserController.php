<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\User;
use app\models\Bulletin;
use app\models\UploadForm;
use app\models\UpdateForm;
use app\models\UpdateBulletinForm;
use yii\web\UploadedFile;
use yii\data\Pagination;
use yii\helpers\Url;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class UserController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ]
        ];
    }

    public function actionIndex()
    {
        $id = Yii::$app->request->get('id');
        $path = Yii::getAlias('/uploads/');
        $user = User::findOne($id);

        $query = Bulletin::find()->where(['user_id' => $user->id]);

        $pagination = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $query->count()
        ]);

        $bulletins = $query->orderBy(['date_add' => SORT_DESC])
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('index', [
            'user' => $user,
            'path' => $path,
            'bulletins' => $bulletins,
            'pagination' => $pagination
        ]);
    }

    public function actionUpload()
    {
        $id = Yii::$app->request->get('id');
        $dir = Yii::getAlias('@app/web/uploads');
        $model = new UploadForm();
        $user = User::findOne($id);

        if (Yii::$app->request->isPost) {
            $model->file = UploadedFile::getInstance($model, 'file');

            if ($model->file && $model->validate()) {

                $model->file->saveAs($dir . '/' . $model->file->baseName . '.' . $model->file->extension);

                $user->avatar = $model->file;
                $user->save();

                Yii::$app->response->redirect(Url::to(['index', 'id' => $user->id]));
            }
        }
        return $this->render('upload', [
            'model' => $model,
            'dir' => $dir
        ]);
    }

    public function actionUpdate()
    {
        $id = Yii::$app->request->get('id');
        $user = User::findOne($id);
        $model = new UpdateForm();

        if($model->load(Yii::$app->request->post()) && $model->validate()){
            $user->username = $model->username;
            $user->email = $model->email;
            if($user->save()){
                return Yii::$app->response->redirect(Url::to(['index', 'id' => $user->id]));
            }
        }

        return $this->render('update', [
            'model' => $model,
            'user' => $user
        ]);
    }

    public function actionUpdateBulletin()
    {
        $id = Yii::$app->request->get('id');
        $bulletin = Bulletin::findOne($id);
        $model = new UpdateBulletinForm();

        if($model->load(Yii::$app->request->post()) && $model->validate()){
            $bulletin->title = $model->title;
            $bulletin->content = $model->content;
            $bulletin->date_add = $model->date_add;
            if($bulletin->save()){
                return Yii::$app->response->redirect(Url::to(['index', 'id' => $bulletin->user_id]));
            }
        }

        return $this->render('updateBulletin', [
            'model' => $model,
            'bulletin' => $bulletin
        ]);
    }
}