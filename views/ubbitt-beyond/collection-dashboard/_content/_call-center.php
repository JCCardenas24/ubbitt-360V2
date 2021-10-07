<ul class="nav nav-pills level-four" id="beyond-cobranza-callcenter-base-datos" role="tablist">
    <li class="nav-item" role="presentation">
        <a class="nav-link  active" id="kpis-info-beyond-cobranza-tab" data-toggle="pill"
            href="#kpis-info-beyond-cobranza" role="tab" aria-controls="kpis-info-beyond-cobranza"
            aria-selected="true">KPI's de telefonía</a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link" id="beyond-cobranza-callcenter-bd-calls-tab" data-toggle="pill"
            href="#beyond-cobranza-callcenter-bd-calls" role="tab" aria-controls="beyond-cobranza-callcenter-bd-calls"
            aria-selected="false">Base de datos (Llamadas)</a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link" id="beyond-cobranza-callcenter-bd-sales-tab" data-toggle="pill"
            href="#beyond-cobranza-callcenter-bd-sales" role="tab" aria-controls="beyond-cobranza-callcenter-bd-sales"
            aria-selected="false">Base de datos (Ventas)</a>
    </li>
</ul>
<div class="tab-content" id="beyond-cobranza-callcenter-base-datosContent">
    <div class="tab-pane fade show active" id="kpis-info-beyond-cobranza" role="tabpanel"
        aria-labelledby="kpis-info-beyond-cobranza-tab">
        <?= $this->render('_call-center/_kpis') ?>
    </div>
    <div class="tab-pane fade" id="beyond-cobranza-callcenter-bd-calls" role="tabpanel"
        aria-labelledby="beyond-cobranza-callcenter-bd-calls-tab">
        <?= $this->render('_call-center/_database-calls') ?>
    </div>
    <div class="tab-pane fade" id="beyond-cobranza-callcenter-bd-sales" role="tabpanel"
        aria-labelledby="beyond-cobranza-callcenter-bd-sales-tab">
        <?= $this->render('_call-center/_database-sales') ?>
    </div>
</div>