<ul class="nav nav-pills level-four" id="beyond-renovacion-callcenter-base-datos" role="tablist">
    <li class="nav-item" role="presentation">
        <a class="nav-link  active" id="kpis-info-beyond-renovacion-tab" data-toggle="pill"
            href="#kpis-info-beyond-renovacion" role="tab" aria-controls="kpis-info-beyond-renovacion"
            aria-selected="true">KPI's de telefonía</a>
    </li>
    <li class="nav-item table_llamadas" role="presentation">
        <a class="nav-link" id="beyond-renovacion-callcenter-bd-tab" data-toggle="pill"
            href="#beyond-renovacion-callcenter-bd" role="tab" aria-controls="beyond-renovacion-callcenter-bd"
            aria-selected="false">Base de datos (Llamadas)</a>
    </li>
</ul>
<div class="tab-content" id="beyond-renovacion-callcenter-base-datosContent">
    <div class="tab-pane fade show active" id="kpis-info-beyond-renovacion" role="tabpanel"
        aria-labelledby="kpis-info-beyond-renovacion-tab">
        <?= $this->render('_call-center/_kpis') ?>
    </div>
    <div class="tab-pane fade" id="beyond-renovacion-callcenter-bd" role="tabpanel"
        aria-labelledby="beyond-renovacion-callcenter-bd-tab">
        <?= $this->render('_call-center/_database') ?>
    </div>
</div>