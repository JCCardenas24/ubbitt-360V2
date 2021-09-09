<?php

/* @var $this yii\web\View */

use yii\web\View;

$this->title = 'Ubbitt 360';
\app\assets\ChartsAsset::register($this);
$this->registerJsFile('@web/assets/js/views/ubbitt-freemium/freemium-dashboard.js', ['position' => View::POS_END, 'depends' => [\app\assets\ChartsAsset::class]]);
$userPermissions = Yii::$app->session->get("userPermissions");
$permissionMap = [
    'kpis-add' => 'button_add_ubbitt_freemium_inbound_reports_kpis_detail',
    'kpis-delete' => 'button_delete_ubbitt_freemium_inbound_reports_kpis_detail',
    'advisor-add' => 'button_add_ubbitt_freemium_inbound_reports_consultant_productivity',
    'advisor-delete' => 'button_delete_ubbitt_freemium_inbound_reports_consultant_productivity',
    'trackers-add' => 'button_add_ubbitt_freemium_inbound_reports_typifications_detail',
    'trackers-delete' => 'button_delete_ubbitt_freemium_inbound_reports_typifications_detail',
    'quality-daily-add' => 'button_add_ubbitt_freemium_inbound_reports_daily_quality',
    'quality-daily-delete' => 'button_delete_ubbitt_freemium_inbound_reports_daily_quality',
    'quality-general-add' => 'button_add_ubbitt_freemium_inbound_reports_general_quality',
    'quality-general-delete' => 'button_delete_ubbitt_freemium_inbound_reports_general_quality',
    'calibrations-add' => 'button_add_ubbitt_freemium_inbound_reports_calibration_result',
    'calibrations-delete' => 'button_delete_ubbitt_freemium_inbound_reports_calibration_result',
];
$this->registerJs('var userPermissions = ' . json_encode($userPermissions) . ';
                var permissionsMap = ' . json_encode($permissionMap) . ';', View::POS_END);
?>
<div class="container container-beyond" id="dynamic-tabs">
    <?= $this->render('../_commons/_tabs/_plans.php') ?>
    <div class="tab-content" id="main_tabs_panelsContent">
        <div class="tab-pane fade show active" id="freemium_option" role="tabpanel"
            aria-labelledby="freemium_option-tab">
            <?= $this->render('_inbound', ['reportFileModel' => $reportFileModel]) ?>
        </div>
    </div>
</div>