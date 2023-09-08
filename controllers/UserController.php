<?php

namespace app\controllers;

use Yii;
use yii\web\Response;
use yii\web\Request;
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

    public function actionLogin()
    {
        $request = Yii::$app->getRequest()->getRawBody();
        $postData = json_decode($request, true);

        $username = $postData['username'];
        $user = User::findOne(['username' => $username]);
        if (!$user) {
            return ['success' => false, 'message' => 'Пользователь не найден'];
        }
        $password = $postData['password'];
        // Сравниваем пароль пользователя с переданным паролем
        if (Yii::$app->security->validatePassword($password, $user->password)) {
            $token = Yii::$app->security->generateRandomString(64);
            $user->api_token = $token;
            $user->save();
            return ['success' => true, 'api_token' => $token, 'user' => $user];
        } else {
            return ['success' => false, 'message' => 'Неверный пароль'];
        }
    }

    public function actionSignup()
    {
        $request = Yii::$app->getRequest()->getRawBody();
        $postData = json_decode($request, true);

        $username = $postData['username'];
        if (User::findOne(['username' => $username])) {
            return ['success' => false, 'message' => 'Пользователь уже существует'];
        }
        $password = $postData['password'];

        $user = new User();
        $user->username = $username;
        $user->password = Yii::$app->security->generatePasswordHash($password);
        // Генерация и сохранение api_token
        $user->api_token = Yii::$app->security->generateRandomString(64);

        if ($user->save()) {
            return ['success' => true, 'message' => 'Регистрация прошла успешно!', 'api_token' => $user->api_token, 'user' => $user];
        } else {
            return ['success' => false, 'message' => 'Ошибка при создании пользователя'];
        }
    }

    public function actionLogout()
    {
        $request = Yii::$app->getRequest()->getRawBody();
        $postData = json_decode($request, true);

        $username = $postData['username'];
        $user = User::findOne(['username' => $username]);
        if (!$user) {
            return ['success' => false, 'message' => 'Пользователь не найден'];
        }
        $password = $postData['password'];
        // Сравниваем пароль пользователя с переданным паролем
        if (Yii::$app->security->validatePassword($password, $user->password)) {
            return ['success' => true, 'user' => $user];
        } else {
            return ['success' => false, 'message' => 'Неверный пароль'];
        }
    }
}