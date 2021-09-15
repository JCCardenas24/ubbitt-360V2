<ul class="nav nav-pills level-four" id="beyond-cobranza-reportes-options" role="tablist">
    <li class="nav-item table_kpis" role="presentation">
        <a class="nav-link nav-link-beyond-collection-reports active" id="beyond-collection-reports-kpis-tab" data-tab-type="kpis" data-toggle="pill"
            href="#beyond-collection-reports-tab-content" role="tab"
            aria-controls="beyond-cobranza-reportes-detalle-kpis" aria-selected="true">Detalle de KPI's</a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link nav-link-beyond-collection-reports" id="beyond-collection-reports-trackers-tab" data-tab-type="trackers" data-toggle="pill"
            href="#beyond-collection-reports-tab-content" role="tab"
            aria-controls="beyond-cobranza-reportes-detalle-tipificaciones" aria-selected="false">Detalle de
            tipificaciones</a>
    </li>
</ul>
<div class="tab-content" id="beyond-collection-reports">
    <div class="tab-pane fade show active" id="beyond-collection-reports-tab-content" role="tabpanel"
        aria-labelledby="beyond-collection-reports-tab">
        <?= $this->render('_reports/_kpis-detail', ['reportFileModel' => $reportFileModel]) ?>
    </div>
</div>