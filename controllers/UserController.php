<?php

namespace app\controllers;

use Yii;
use yii\web\Response;
use app\models\User;
use yii\web\Controller as BaseController;

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
    public function actionLogin()
    {
        // Получаем данные из POST-запроса
        $username = Yii::$app->request->post('username');
        $password = Yii::$app->request->post('password');

        // Находим пользователя по имени пользователя (username)
        $user = User::findOne(['username' => $username]);

        // Если пользователь не найден
        if (!$user) {
            return ['success' => false, 'message' => 'Пользователь не найден'];
        }

        // Сравниваем пароль пользователя с переданным паролем
        if (Yii::$app->security->validatePassword($password, $user->password)) {
            // Пароль верный
            return ['success' => true, 'user' => $user];
        } else {
            // Пароль неверный
            return ['success' => false, 'message' => 'Неверный пароль'];
        }
    }
}