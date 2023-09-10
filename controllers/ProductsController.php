<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Response;
use yii\web\Request;
use app\models\Product;
use \Firebase\JWT\JWT;
use Firebase\JWT\Key;
use app\models\User;

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
        $jwtData = Yii::$app->getRequest()->getHeaders()->get('jwtData');
        if ($jwtData && isset($jwtData['success'])) {
            if (!$jwtData['success']) {
                return ['success' => false, 'message' => $jwtData['success']];
            }
        }
        $request = Yii::$app->getRequest()->getRawBody();
        $postData = json_decode($request, true);

        $name = $postData['name'];
        $category_name = $postData['category_name'];
        $brand_name = $postData['brand_name'];
        $price = $postData['price'];
        $rrp_price = $postData['rrp_price'];
        $status = $postData['status'];
        $description = $postData['description'];

        $product = new Product();

        $product->name = $name;
        $product->category_name = $category_name;
        $product->brand_name = $brand_name;
        $product->price = $price;
        $product->rrp_price = $rrp_price;
        $product->status = $status;
        $product->description = $description;
        if ($product->save()) {
            return ['success' => true, 'message' => 'Товар создан!'];
        } else {
            return ['success' => false, 'message' => 'Ошибка при создании пользователя'];
        }
    }
}