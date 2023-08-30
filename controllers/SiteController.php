<?php

namespace app\controllers;

use Yii;
use yii\web\Controller as BaseController;
class SiteController extends BaseController
{
    public function actionIndex()
    {
        return $this->render('index'); // Возвращаем представление для действия index
    }
}
