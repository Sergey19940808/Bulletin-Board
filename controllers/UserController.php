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

class UserController extends Controller
{
    public function actionIndex()
    {
        $path = Yii::getAlias('/uploads/');
        $user = User::findIdentity(Yii::$app->user->identity->getId());

        $query = Bulletin::find()->where(['user_id' => $user]);

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
        $dir = Yii::getAlias('@app/web/uploads');
        $model = new UploadForm();
        $user = User::findOne(Yii::$app->user->identity->getId());

        if (Yii::$app->request->isPost) {
            $model->file = UploadedFile::getInstance($model, 'file');

            if ($model->file && $model->validate()) {

                // delete previous avatar
                $this->clear($dir.'/'.$user->avatar);

                $model->file->saveAs($dir . '/' . $model->file->baseName . '.' . $model->file->extension);

                $user->avatar = $model->file;
                $user->save();

                $this->redirect('index');
            }
        }
        return $this->render('upload', [
            'model' => $model,
            'dir' => $dir
        ]);
    }

    public function actionUpdate()
    {
        $user = User::findOne(Yii::$app->user->identity->getId());
        $model = new UpdateForm();

        if($model->load(Yii::$app->request->post()) && $model->validate()){
            $user->username = $model->username;
            $user->email = $model->email;
            if($user->save()){
                return $this->redirect('/user/index');
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
                return $this->redirect('/user/index');
            }
        }

        return $this->render('updateBulletin', [
            'model' => $model,
            'bulletin' => $bulletin
        ]);
    }

    public function clear($dir) {
        if (file_exists($dir)) {
            unlink($dir);
        }
    }
}