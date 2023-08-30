<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\Cors;
use yii\web\Response;
use app\models\User;

class UserController extends Controller
{
    public function behaviors()
    {
        return [
            'corsFilter' => [
                'class' => Cors::class,
                'cors' => [
                    'Origin' => ['https://tranquil-island-01847-9479261fef91.herokuapp.com'],
                    'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'OPTIONS'],
                    'Access-Control-Request-Headers' => ['*'],
                    'Access-Control-Allow-Credentials' => true,
                    'Access-Control-Max-Age' => 86400,
                ],
            ],
        ];
    }

    public function actionGetUsers()
    {
        error_log("actionGetUsers method called");
        Yii::$app->response->format = Response::FORMAT_JSON;

        $users = User::find()->asArray()->all();
        return $users;
    }

    public function actionIndex()
    {
        return $this->render('index'); // Возвращаем представление для действия index
    }
}