<?php

namespace app\controllers;

use Yii;
class SiteController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index'); // Возвращаем представление для действия index
    }
}
