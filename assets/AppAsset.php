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
        'assets/css/daterangepicker/daterangepicker.css',
        'https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css',
        'assets/css/main.min.css',
    ];
    public $js = [
        'assets/js/vendors.min.js',
        'assets/js/common/alert.js',
        'assets/js/common/menu.js',
        'assets/js/common/autonumeric-4.5.4.js',
        'assets/js/functions.js',
        'assets/icons/feather-icons/feather.min.js',
        'assets/js/template.js',
        'assets/js/demo.js',
        'assets/js/moment/moment.min.js',
        'assets/js/daterangepicker/daterangepicker.min.js',
        'assets/js/tables.js',
        'assets/js/general.js',
        'assets/js/common/pagination.js',
        'assets/js/common/file.js',
        'assets/js/common/preloader.js',
        'assets/js/datatables/jquery.dataTables-v1.10.11.min.js',
        'assets/js/datatables/dataTables.fixedColumns-v3.2.1.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}