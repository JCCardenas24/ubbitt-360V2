<ul class="nav nav-pills level-four" id="beyond-cobranza-callcenter-base-datos" role="tablist">
    <li class="nav-item" role="presentation">
        <a class="nav-link  active" id="kpis-info-beyond-cobranza-tab" data-toggle="pill"
            href="#kpis-info-beyond-cobranza" role="tab" aria-controls="kpis-info-beyond-cobranza"
            aria-selected="true">KPI's de telefonía</a>
    </li>
    <li class="nav-item table_llamadas" role="presentation">
        <a class="nav-link" id="beyond-cobranza-callcenter-bd-tab" data-toggle="pill"
            href="#beyond-cobranza-callcenter-bd" role="tab" aria-controls="beyond-cobranza-callcenter-bd"
            aria-selected="false">Base de datos (Llamadas)</a>
    </li>
</ul>
<div class="tab-content" id="beyond-cobranza-callcenter-base-datosContent">
    <div class="tab-pane fade show active" id="kpis-info-beyond-cobranza" role="tabpanel"
        aria-labelledby="kpis-info-beyond-cobranza-tab">
        <?= $this->render('_call-center/_kpis') ?>
    </div>
    <div class="tab-pane fade" id="beyond-cobranza-callcenter-bd" role="tabpanel"
        aria-labelledby="beyond-cobranza-callcenter-bd-tab">
        <?= $this->render('_call-center/_database') ?>
    </div>
</div>