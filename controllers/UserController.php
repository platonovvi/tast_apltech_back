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
    private function jsonResponse($success, $message, $data = [])
    {
        //Yii::$app->response->format = Response::FORMAT_JSON;
        return [
            'success' => $success,
            'message' => $message,
            'data' => $data,
        ];
    }

    public function actionLogin()
    {
        // Получаем данные из POST-запросаv
        $request = Yii::$app->getRequest();
        $username = $request->post('username');
        $password = $request->post('password');

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

    public function actionLogout()
    {
        // Получаем данные из POST-запроса
        $request = Yii::$app->getRequest();
        $username = $request->post('username');
        $password = $request->post('password');

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

    public function actionSignup()
    {
        $request = Yii::$app->getRequest()->getRawBody();
        $postData = json_decode($request, true);

        $username = $postData['username'];
        if (!$username) {
            return $this->jsonResponse(false, 'Введите Логин');
        }
        if (User::findOne(['username' => $username])) {
            return $this->jsonResponse(false, 'Пользователь уже существует');
        }
        $password = $postData['password'];
        if (!$password) {
            return $this->jsonResponse(false, 'Введите пароль');
        }

        $user = new User();
        $user->username = $username;
        $user->password = Yii::$app->security->generatePasswordHash($password);
        if ($user->save()) {
            return $this->jsonResponse(true, 'Пользователь успешно создан', ['user' => $user]);
        } else {
            return $this->jsonResponse(false, 'Ошибка при создании пользователя');
        }
    }
}