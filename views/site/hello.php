<?php

use yii\helpers\Html;

$this->title = 'Hello';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-hello">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        Привет, мир! Это простое представление Yii2, развернутое на Heroku.
    </p>
</div>

