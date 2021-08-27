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
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'assets/css/vendors_css.css',
        'assets/css/style.css',
        'assets/icons/font-awesome/css/font-awesome.css',
        'assets/css/crm-styles.css',
        'assets/libs/datatables/datatables.min.css',
        'https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css',
        'https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css',
        'assets/css/main.min.css',
    ];
    public $js = [
        'assets/js/functions.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}