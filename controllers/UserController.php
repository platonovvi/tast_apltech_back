<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use app\models\User;

class UserController extends Controller
{
    public function actionGetUsers()
    {
        dd(123123);
        Yii::$app->response->format = Response::FORMAT_JSON;

        $users = User::find()->all();

        return $users;
    }
}