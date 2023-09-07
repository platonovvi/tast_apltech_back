<?php

namespace app\commands;

use Yii;
use yii\console\Controller;
use app\models\User;

class CreateUserCommand extends Controller
{
    public function actionIndex($username, $password)
    {
        $user = new User();
        $user->username = $username;
        $user->password = Yii::$app->security->generatePasswordHash($password);

        if ($user->save()) {
            echo "Пользователь '{$username}' успешно создан.\n";
        } else {
            echo "Ошибка при создании пользователя.\n";
            print_r($user->getErrors());
        }
    }
}