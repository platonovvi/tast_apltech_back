<?php

namespace app\controllers;

use Yii;
use yii\web\Response;
use yii\web\Request;
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

        $request = Yii::$app->getRequest();
        $username = $request->post('username');
        $password = $request->post('password');

        $user = new User();
        return $this->asJson(['success' => true, 'message' => $user]);
        /*$user->username = $username;
        $user->password = Yii::$app->security->generatePasswordHash($password);
        if ($user->save()) {
            return $this->asJson(['success' => true, 'message' => 'Пользователь успешно создан']);
        } else {
            return $this->asJson(['success' => false, 'message' => 'Ошибка при создании пользователя', 'errors' => $user->getErrors()]);
        }*/
    }
}