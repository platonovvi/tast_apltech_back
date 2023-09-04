<?php

namespace app\controllers;

use Yii;
use yii\web\Response;
use app\models\User;
use yii\web\Controller as BaseController;

class UserController extends BaseController
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
        echo 'Код дошел сюда.';
        die(); // или exit();
        $content = 'Content';
        //return $this->render('index');
        //return $this->renderContent($content);
        $users = User::find()->asArray()->all();
        return $this->asJson($users);
    }
}