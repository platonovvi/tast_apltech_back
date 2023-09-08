<?php

namespace app\controllers;

use app\models\User;
use yii\web\Response;
use app\models\Product;

class ProductsController extends Controller
{
    public function actionGetProducts(): Response
    {
        $query = Product::find()->asArray()->all();
        return $this->asJson(['success' => true, 'products' => $query]);
    }

    public function actionGetProduct($id): Response
    {
        $query = Product::findOne($id);
        if ($query === null) {
            return $this->asJson(['success' => false, 'message' => 'Товар не найден']);
        }
        return $this->asJson(['success' => true, 'product' => $query]);
    }

    public function actionCreate()
    {
        $request = Yii::$app->getRequest()->getRawBody();
        $postData = json_decode($request, true);
        $product = new Product();
        $product->name = $postData['name'];
        $product->category_name = $postData['category_name'];
        $product->brand_name = $postData['brand_name'];
        $product->price = $postData['price'];
        $product->rrp_price = $postData['rrp_price'];
        $product->status = $postData['status'];
        $product->description = $postData['description'];
        return ['success' => true, 'message' => 'dwq'];
        if ($product->save()) {
            return ['success' => true, 'message' => 'Товар создан!'];
        } else {
            return ['success' => false, 'message' => 'Ошибка при создании пользователя'];
        }
    }
}