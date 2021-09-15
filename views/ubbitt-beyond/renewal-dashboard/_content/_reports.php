<ul class="nav nav-pills level-four" id="beyond-renovacion-reportes-options" role="tablist">
    <?php if (in_array('menu_ubbitt_beyond_renewal_reports_kpis_detail', Yii::$app->session->get("userPermissions"))): ?>
    <li class="nav-item table_kpis" role="presentation">
        <a class="nav-link nav-link-beyond-renewal-reports active" id="beyond-renewal-reports-kpis-tab" data-tab-type="kpis" data-toggle="pill"
            href="#beyond-renewal-reports-tab-content" role="tab"
            aria-controls="beyond-renovacion-reportes-detalle-kpis" aria-selected="true">Detalle de KPI's</a>
    </li>
    <?php endif; ?>
    <?php if (in_array('menu_ubbitt_beyond_renewal_reports_typifications_detail', Yii::$app->session->get("userPermissions"))): ?>
    <li class="nav-item" role="presentation">
        <a class="nav-link nav-link-beyond-renewal-reports" id="beyond-renewal-reports-trackers-tab" data-tab-type="trackers" data-toggle="pill"
            href="#beyond-renewal-reports-tab-content" role="tab"
            aria-controls="beyond-renovacion-reportes-detalle-tipificaciones" aria-selected="false">Detalle de
            tipificaciones</a>
    </li>
    <?php endif; ?>
    <?php if (in_array('menu_ubbitt_beyond_renewal_reports_productivity_detail', Yii::$app->session->get("userPermissions"))): ?>
    <li class="nav-item" role="presentation">
        <a class="nav-link nav-link-beyond-renewal-reports" id="beyond-renewal-reports-productivity-tab" data-tab-type="productivity" data-toggle="pill"
            href="#beyond-renewal-reports-tab-content" role="tab"
            aria-controls="beyond-renovacion-reportes-detalle-tipificaciones" aria-selected="false">De productividad</a>
    </li>
    <?php endif; ?>
</ul>
<div class="tab-content" id="beyond-renewal-reports">
    <div class="tab-pane fade show active" id="beyond-renewal-reports-tab-content" role="tabpanel"
        aria-labelledby="beyond-renewal-reports-tab">
        <?= $this->render('_reports/_kpis-detail', ['reportFileModel' => $reportFileModel]) ?>
    </div>
</div>