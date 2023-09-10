<?php

namespace app\controllers;

use Yii;
use yii\web\Controller as BaseController;
use yii\filters\Cors;
use yii\filters\AccessControl;
use app\models\User;
use \Firebase\JWT\JWT;
use Firebase\JWT\Key;
class Controller extends BaseController
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
            'jwtFilter' => [
                'class' => AccessControl::class,
                'only' => ['product/create'],
                'rules' => [
                    [
                        'actions' => ['product/create'],
                        'allow' => true,
                        'matchCallback' => function ($rule, $action) {
                            // Ваш код проверки JWT токена
                            $token = Yii::$app->getRequest()->getHeaders()->get('Authorization');
                            if (!$token) {
                                return false; // Отказать в доступе, если токен отсутствует
                            }

                            $token = str_replace('Bearer ', '', $token);
                            $secretKey = getenv('SECRET_KEY_JWT');

                            try {
                                $payload = JWT::decode($token, new Key($secretKey, 'HS256'));
                                $user = User::findOne(['id' => $payload->sub]);
                                return $user !== null; // Разрешить доступ, если пользователь найден
                            } catch (\Exception $e) {
                                return false; // Отказать в доступе в случае ошибки при декодировании токена
                            }
                        },
                    ],
                ],
            ],
        ];
    }
}