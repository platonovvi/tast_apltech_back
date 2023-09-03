<?php

namespace app\controllers;

use Yii;
use yii\web\Response;
use app\models\User;

class UserController extends Controller
{
    /*public function behaviors()
    {
        return [
            'access' => [
                'class' => 'yii\filters\AccessControl',
                'rules' => [
                    [
                        'actions' => ['get-users'],
                        'allow' => true,
                        'roles' => ['admin'], // Примерная роль для доступа
                    ],
                    // Другие правила...
                ],
            ],
        ];
    }*/
    public function actionGetUsers()
    {
        $content = 'Content';
        return $this->renderContent($content);
        /*$users = User::find()->asArray()->all();
        return $this->asJson($users);*/
    }
}