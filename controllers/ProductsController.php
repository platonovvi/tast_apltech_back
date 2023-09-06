<?php

namespace app\controllers;

use yii\web\Response;
use app\models\Product;

class ProductsController extends Controller
{
    public function actionGetProducts(): Response
    {
        $query = Product::find()->asArray()->all();
        return $this->asJson($query);
    }
}