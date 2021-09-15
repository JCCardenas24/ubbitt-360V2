<?php

/* @var $this yii\web\View */

use yii\web\View;

$this->title = 'Ubbitt 360';
\app\assets\ChartsAsset::register($this);
$this->registerJsFile('@web/assets/js/views/ubbitt-beyond/collection-dashboard.js', ['position' => View::POS_END, 'depends' => [\app\assets\ChartsAsset::class]]);
$userPermissions = Yii::$app->session->get("userPermissions");
$permissionMap = [
    'kpis-add' => 'button_add_ubbitt_beyond_collection_reports_kpis_detail',
    'kpis-delete' => 'button_delete_ubbitt_beyond_collection_reports_kpis_detail',
    'trackers-add' => 'button_add_ubbitt_beyond_collection_reports_typifications_detail',
    'trackers-delete' => 'button_delete_ubbitt_beyond_collection_reports_typifications_detail',
    'productivity-add' => 'button_add_ubbitt_beyond_collection_reports_productivity_detail',
    'productivity-delete' => 'button_delete_ubbitt_beyond_collection_reports_productivity_detail',
];
$this->registerJs('var userPermissions = ' . json_encode($userPermissions) . ';
                var permissionsMap = ' . json_encode($permissionMap) . ';', View::POS_END);
?>
<div class="container container-beyond" id="dynamic-tabs">
    <?= $this->render('../_commons/_tabs/_plans.php') ?>
    <div class="tab-content" id="main_tabs_panelsContent">
        <div class="tab-pane fade show active" id="beyond_option" role="tabpanel" aria-labelledby="beyond_option-tab">
            <?= $this->render('_menu') ?>
            <div class="tab-content" id="beyond-homeContent">
                <div class="tab-pane fade show active" id="cobranza-home" role="tabpanel"
                    aria-labelledby="cobranza-home-tab">
                    <?= $this->render('collection-dashboard/_submenu') ?>
                    <?= $this->render('collection-dashboard/_content', ['reportFileModel' => $reportFileModel]) ?>
                </div>
            </div>
        </div>
    </div>
</div>