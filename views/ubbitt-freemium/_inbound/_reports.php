<ul class="nav nav-pills level-four" id="freemium-inbound-reportes-options" role="tablist">
    <?php
    if (in_array('menu_ubbitt_freemium_inbound_reports_kpis_detail', Yii::$app->session->get("userPermissions"))) {
    ?>
    <li class="nav-item" role="presentation">
        <a class="nav-link nav-link-freemium-reports active" data-tab-type="kpis"
            id="freemium-inbound-reportes-detalle-kpis-tab" data-toggle="pill"
            href="#freemium-inbound-reportes-detalle-kpis" role="tab"
            aria-controls="freemium-inbound-reportes-detalle-kpis" aria-selected="true">Detalles de KPI's</a>
    </li>
    <?php } ?>
    <?php
    if (in_array('menu_ubbitt_freemium_inbound_reports_consultant_productivity', Yii::$app->session->get("userPermissions"))) {
    ?>
    <li class="nav-item" role="presentation">
        <a class="nav-link nav-link-freemium-reports" data-tab-type="advisor" data-toggle="pill"
            href="#freemium-inbound-reportes-detalle-kpis" role="tab"
            aria-controls="freemium-inbound-reportes-detalle-kpis" aria-selected="false">Productividad de asesores</a>
    </li>
    <?php } ?>
    <?php
    if (in_array('menu_ubbitt_freemium_inbound_reports_typifications_detail', Yii::$app->session->get("userPermissions"))) {
    ?>
    <li class="nav-item" role="presentation">
        <a class="nav-link nav-link-freemium-reports" data-tab-type="trackers" data-toggle="pill"
            href="#freemium-inbound-reportes-detalle-kpis" role="tab"
            aria-controls="freemium-inbound-reportes-detalle-kpis" aria-selected="false">Detalle de tipificaciones</a>
    </li>
    <?php } ?>
    <?php
    if (in_array('menu_ubbitt_freemium_inbound_reports_daily_quality', Yii::$app->session->get("userPermissions"))) {
    ?>
    <li class="nav-item" role="presentation">
        <a class="nav-link nav-link-freemium-reports" data-tab-type="quality-daily" data-toggle="pill"
            href="#freemium-inbound-reportes-detalle-kpis" role="tab"
            aria-controls="freemium-inbound-reportes-detalle-kpis" aria-selected="false">De calidad diario</a>
    </li>
    <?php } ?>
    <?php
    if (in_array('menu_ubbitt_freemium_inbound_reports_general_quality', Yii::$app->session->get("userPermissions"))) {
    ?>
    <li class="nav-item" role="presentation">
        <a class="nav-link nav-link-freemium-reports" data-tab-type="quality-general" data-toggle="pill"
            href="#freemium-inbound-reportes-detalle-kpis" role="tab"
            aria-controls="freemium-inbound-reportes-detalle-kpis" aria-selected="false">General de calidad</a>
    </li>
    <?php } ?>
    <?php
    if (in_array('menu_ubbitt_freemium_inbound_reports_calibration_result', Yii::$app->session->get("userPermissions"))) {
    ?>
    <li class="nav-item" role="presentation">
        <a class="nav-link nav-link-freemium-reports" data-tab-type="calibrations" data-toggle="pill"
            href="#freemium-inbound-reportes-detalle-kpis" role="tab"
            aria-controls="freemium-inbound-reportes-detalle-kpis" aria-selected="false">Resultado de calibraciones</a>
    </li>
    <?php } ?>
</ul>
<div class="tab-content" id="freemium-inbound-reportes-optionsContent">
    <div class="tab-pane fade show active" id="freemium-inbound-reportes-detalle-kpis" role="tabpanel"
        aria-labelledby="freemium-inbound-reportes-detalle-kpis-tab">
        <?= $this->render('_reports/_kpis-detail', ['reportFileModel' => $reportFileModel]) ?>
    </div>

</div>