<?php
/* @var $this yii\web\View */

use yii\web\View;

$this->registerJsFIle('@web/assets/js/views/report/upload.js', ['position' => View::POS_END, 'depends' => [\app\assets\AppAsset::class]]);
?>
<?= $this->render('../_commons/_plans/_database-upload') ?>