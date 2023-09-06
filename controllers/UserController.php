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

        try {
            Yii::$app->db->open();
            echo "Подключение к базе данных успешно установлено.";
        } catch (\yii\db\Exception $e) {
            echo getenv('DATABASE_URL') . $e->getMessage();
        }
        //Yii::debug("Маршрут до контроллера UserController::actionGetUsers достигнут!");
        //echo "Действие actionGetUsers вызвано!";
        //return $this->render('index'); // Возвращаем представление для действия index
        /*$users = User::find()->asArray()->all();
        return $this->asJson($users);*/
    }
}