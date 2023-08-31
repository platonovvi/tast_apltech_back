<?php

namespace app\controllers;

use Yii;
use yii\web\Response;
use app\models\User;

class UserController extends Controller
{
    public function actionGetUsers()
    {
        return $this->render('index');
        /*Yii::$app->response->format = Response::FORMAT_JSON;

        $users = User::find()->asArray()->all();
        return $this->asJson($users);*/
    }
}