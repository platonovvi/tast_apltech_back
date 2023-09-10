<?php

namespace app\controllers;

use Yii;
use yii\web\Response;
use yii\web\Request;
use app\models\User;
use \Firebase\JWT\JWT;

class UserController extends Controller
{
    public function actionAuth()
    {
        $token = Yii::$app->getRequest()->getHeaders()->get('Authorization');

        if (!$token) {
            return ['success' => false, 'message' => 'Отсутствует заголовок Authorization с токеном'];
        }

        $token = str_replace('Bearer ', '', $token);
        $secretKey = getenv('SECRET_KEY_JWT');

        try {
            // Попробуйте декодировать токен
            $payload = \Firebase\JWT\JWT::decode($token, $secretKey, ['HS256']);

            // Проверьте, что токен успешно декодирован
            if ($payload) {
                // Верните успешный результат и информацию о пользователе из полезной нагрузки
                return ['success' => true, 'user' => $payload];
            } else {
                return ['success' => false, 'message' => 'Неверный токен. Пользователь не аутентифицирован'];
            }
        } catch (\Firebase\JWT\ExpiredException $e) {
            return ['success' => false, 'message' => 'Истек срок действия токена'];
        } catch (\Firebase\JWT\SignatureInvalidException $e) {
            return ['success' => false, 'message' => 'Неверная подпись токена'];
        } catch (\Exception $e) {
            return ['success' => false, 'message' => 'Неверный токен. Пользователь не аутентифицирован'];
        }
    }

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

    /*public function actionSignup()
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
        // Генерация $secretKey
        $secretKey = Yii::$app->security->generateRandomString(64);
        $user->api_token = $secretKey;
        if ($user->save()) {
            // Создайте полезную нагрузку для JWT токена
            $payload = [
                'sub' => $user->id,
                'exp' => time() + 3600, // Время истечения токена (1 час)
            ];
            $api_token = Yii::$app->getSecurity()->hashData(json_encode($payload), $secretKey);
            return ['success' => true, 'message' => 'Регистрация прошла успешно!', 'api_token' => $api_token, 'user' => $user];
        } else {
            return ['success' => false, 'message' => 'Ошибка при создании пользователя'];
        }
    }*/

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

        $api_token = $this->generateJwtToken($user);
        $user->api_token = $api_token;
        if ($user->save()) {
            return ['success' => true, 'message' => 'Регистрация прошла успешно!', 'api_token' => $user->api_token, 'user' => $user];
        } else {
            return ['success' => false, 'message' => 'Ошибка при создании пользователя'];
        }
    }

    private function generateJwtToken($user)
    {
        $secretKey = getenv('SECRET_KEY_JWT');
        $payload = [
            'sub' => $user->id,
            'exp' => time() + 3600, // Время истечения токена (1 час)
        ];

        return JWT::encode($payload, $secretKey, 'HS256');
    }
}