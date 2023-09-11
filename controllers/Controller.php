<?php

namespace app\controllers;

use Yii;
use yii\web\Controller as BaseController;
use yii\filters\Cors;
use \Firebase\JWT\JWT;
use Firebase\JWT\Key;
use app\models\User;
use yii\filters\AccessControl;

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
                'only' => ['create', 'update'],
                'rules' => [
                    [
                        'actions' => ['create', 'update'],
                        'allow' => true,
                        'matchCallback' => function ($rule, $action) {
                            // Ваш код проверки JWT токена
                            $token = Yii::$app->getRequest()->getHeaders()->get('Authorization');
                            if (!$token) {
                                return false;
                            }

                            $token = str_replace('Bearer ', '', $token);
                            $secretKey = getenv('SECRET_KEY_JWT');

                            try {
                                $payload = JWT::decode($token, new Key($secretKey, 'HS256'));
                                $user = User::findOne(['id' => $payload->sub]);
                                return $user !== null;
                            } catch (\Exception $e) {
                                return false;
                            }
                        },
                    ],
                ],
            ],
        ];
    }
}