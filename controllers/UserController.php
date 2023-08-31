<?php

namespace app\controllers;

use Yii;
use yii\web\Response;
use app\models\User;
use yii\web\Controller as BaseController;

class UserController extends BaseController
{
    public function actionGetUsers()
    {
        return null;
        /*Yii::$app->response->format = Response::FORMAT_JSON;

        $users = User::find()->asArray()->all();
        return $this->asJson($users);*/
    }
}