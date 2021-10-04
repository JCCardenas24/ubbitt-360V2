<ul class="nav nav-pills level-four" id="freemium-call-center-options" role="tablist">
    <li class="nav-item" role="presentation">
        <a class="nav-link active" id="freemium-call-center-kpis-tab" data-toggle="pill"
            href="#freemium-call-center-kpis" role="tab" aria-controls="freemium-call-center-kpis"
            aria-selected="true">KPI's de telefonía</a>
    </li>
    <li class="nav-item table_llamadas" role="presentation">
        <a class="nav-link nav-link-freemium-database" id="freemium-call-center-bd-calls-tab" data-toggle="pill" href="#freemium-call-center-bd-calls"
            role="tab" aria-controls="freemium-call-center-bd" aria-selected="false" data-tab-type="calls">Base de Datos (Llamadas)</a>
    </li>
    <li class="nav-item table_llamadas" role="presentation">
        <a class="nav-link nav-link-freemium-database" id="freemium-call-center-bd-sales-tab" data-toggle="pill" href="#freemium-call-center-bd-sales"
            role="tab" aria-controls="freemium-call-center-bd" aria-selected="false" data-tab-type="sales">Base de Datos (Ventas)</a>
    </li>
</ul>
<div class="tab-content" id="freemium-call-center-optionsContent">
    <div class="tab-pane fade show active" id="freemium-call-center-kpis" role="tabpanel"
        aria-labelledby="freemium-call-center-kpis-tab">
        <?= $this->render('_call-center/_kpis') ?>
    </div>
    <div class="tab-pane fade" id="freemium-call-center-bd-calls" role="tabpanel"
        aria-labelledby="freemium-call-center-bd-tab">
        <?= $this->render('_call-center/_database-calls') ?>
    </div>
    <div class="tab-pane fade" id="freemium-call-center-bd-sales" role="tabpanel"
        aria-labelledby="freemium-call-center-bd-tab">
        <?= $this->render('_call-center/_database-sales') ?>
    </div>
</div>