<?php

namespace app\controllers;

namespace app\controllers;

use yii\web\Controller as BaseController;

class TestController extends BaseController
{
    public function actionNullResponse()
    {
        return null;
    }
}