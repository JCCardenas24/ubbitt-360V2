<ul class="nav nav-pills level-four" id="beyond-renovacion-callcenter-base-datos" role="tablist">
    <li class="nav-item" role="presentation">
        <a class="nav-link  active" id="kpis-info-beyond-renovacion-tab" data-toggle="pill"
            href="#kpis-info-beyond-renovacion" role="tab" aria-controls="kpis-info-beyond-renovacion"
            aria-selected="true">KPI's de telefonía</a>
    </li>
    <li class="nav-item table_llamadas" role="presentation">
        <a class="nav-link" id="beyond-renovacion-callcenter-bd-calls-tab" data-toggle="pill"
            href="#beyond-renovacion-callcenter-bd-calls" role="tab" aria-controls="beyond-renovacion-callcenter-bd-calls"
            aria-selected="false">Base de datos (Llamadas)</a>
    </li>
    <li class="nav-item table_llamadas" role="presentation">
        <a class="nav-link" id="beyond-renovacion-callcenter-bd-sales-tab" data-toggle="pill"
            href="#beyond-renovacion-callcenter-bd-sales" role="tab" aria-controls="beyond-renovacion-callcenter-bd-sales"
            aria-selected="false">Base de datos (Ventas)</a>
    </li>
</ul>
<div class="tab-content" id="beyond-renovacion-callcenter-base-datosContent">
    <div class="tab-pane fade show active" id="kpis-info-beyond-renovacion" role="tabpanel"
        aria-labelledby="kpis-info-beyond-renovacion-tab">
        <?= $this->render('_call-center/_kpis') ?>
    </div>
    <div class="tab-pane fade" id="beyond-renovacion-callcenter-bd-calls" role="tabpanel"
        aria-labelledby="beyond-renovacion-callcenter-bd-calls-tab">
        <?= $this->render('_call-center/_database-calls') ?>
    </div>
    <div class="tab-pane fade" id="beyond-renovacion-callcenter-bd-sales" role="tabpanel"
        aria-labelledby="beyond-renovacion-callcenter-bd-sales-tab">
        <?= $this->render('_call-center/_database-sales') ?>
    </div>
</div>