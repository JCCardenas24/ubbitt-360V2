<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class TermsAndConditionsAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css',
        'assets/css/aviso-privacidad.css',
    ];
    public $js = [
        'assets/js/vendors.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}