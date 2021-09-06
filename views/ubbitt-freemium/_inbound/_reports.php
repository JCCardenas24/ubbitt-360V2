<ul class="nav nav-pills level-four" id="freemium-inbound-reportes-options" role="tablist">
    <li class="nav-item" role="presentation">
        <a class="nav-link active" id="freemium-inbound-reportes-detalle-kpis-tab" data-toggle="pill"
            href="#freemium-inbound-reportes-detalle-kpis" role="tab"
            aria-controls="freemium-inbound-reportes-detalle-kpis" aria-selected="true">Detalles de KPI's</a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link " data-toggle="pill" href="#freemium-inbound-reportes-detalle-kpis" role="tab"
            aria-controls="freemium-inbound-reportes-detalle-kpis" aria-selected="false">Productividad de asesores</a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link " data-toggle="pill" href="#freemium-inbound-reportes-detalle-kpis" role="tab"
            aria-controls="freemium-inbound-reportes-detalle-kpis" aria-selected="false">Detalle de tipificaciones</a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link " data-toggle="pill" href="#freemium-inbound-reportes-detalle-kpis" role="tab"
            aria-controls="freemium-inbound-reportes-detalle-kpis" aria-selected="false">De calidad diario</a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link " data-toggle="pill" href="#freemium-inbound-reportes-detalle-kpis" role="tab"
            aria-controls="freemium-inbound-reportes-detalle-kpis" aria-selected="false">General de calidad</a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link " data-toggle="pill" href="#freemium-inbound-reportes-detalle-kpis" role="tab"
            aria-controls="freemium-inbound-reportes-detalle-kpis" aria-selected="false">Resultado de calibraciones</a>
    </li>
</ul>
<div class="tab-content" id="freemium-inbound-reportes-optionsContent">
    <div class="tab-pane fade show active" id="freemium-inbound-reportes-detalle-kpis" role="tabpanel"
        aria-labelledby="freemium-inbound-reportes-detalle-kpis-tab">
        <?= $this->render('_reports/_kpis-detail', ['reportFileModel' => $reportFileModel, 'dataReportFileProvider' => $dataReportFileProvider]) ?>
    </div>

</div>