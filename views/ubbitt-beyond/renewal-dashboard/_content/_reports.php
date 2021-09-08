<ul class="nav nav-pills level-four" id="beyond-renovacion-reportes-option" role="tablist">
    <li class="nav-item" role="presentation">
        <a class="nav-link active" id="beyond-renovacion-reportes-detalle-kpis-tab" data-toggle="pill"
            href="#beyond-renovacion-reportes-detalle-kpis" role="tab"
            aria-controls="beyond-renovacion-reportes-detalle-kpis" aria-selected="true">Detalle de KPI's</a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link" id="beyond-renovacion-reportes-detalle-de-tipificaciones-tab" data-toggle="pill"
            href="#beyond-renovacion-reportes-detalle-de-tipificaciones" role="tab"
            aria-controls="beyond-renovacion-reportes-detalle-de-tipificaciones" aria-selected="false">Detalle de
            tipificaciones</a>
    </li>

</ul>
<div class="tab-content" id="beyond-renovacion-reportes-optionContent">
    <div class="tab-pane fade show active" id="beyond-renovacion-reportes-detalle-kpis" role="tabpanel"
        aria-labelledby="beyond-renovacion-reportes-detalle-kpis-tab">
        <?= $this->render('_reports/_kpis-detail') ?>
    </div>
    <div class="tab-pane fade" id="beyond-renovacion-reportes-detalle-de-tipificaciones" role="tabpanel"
        aria-labelledby="beyond-renovacion-reportes-detalle-de-tipificaciones-tab">
        <?= $this->render('_reports/_typing-detail') ?>
    </div>

</div>