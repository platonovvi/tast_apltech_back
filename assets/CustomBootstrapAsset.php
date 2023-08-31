<?php
/**
 * @link https://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license https://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\bootstrap5\BootstrapAsset;

class CustomBootstrapAsset  extends BootstrapAsset
{
    public $js = [
        'dist/js/bootstrap.bundle.js', // Подключение файла bootstrap.bundle.js
    ];
}