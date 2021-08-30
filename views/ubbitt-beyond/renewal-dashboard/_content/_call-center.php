<ul class="nav nav-pills level-four" id="beyond-renovacion-callcenter" role="tablist">
    <li class="nav-item" role="presentation">
        <a class="nav-link  active" id="kpis-info-beyond-renovacion-tab" data-toggle="pill"
            href="#kpis-info-beyond-renovacion" role="tab" aria-controls="kpis-info-beyond-renovacion"
            aria-selected="true">KPI's de telefonía</a>
    </li>

    <li class="nav-item" role="presentation">
        <a class="nav-link" id="call-base de datos-info-renovacion-tab" data-toggle="pill"
            href="#call-base de datos-info-renovacion" role="tab" aria-controls="call-base de datos-info-renovacion"
            aria-selected="false">Base de datos (Llamadas)</a>
    </li>
</ul>
<div class="tab-content" id="beyond-renovacion-callcenterContent">
    <div class="tab-pane fade show active" id="kpis-info-beyond-renovacion" role="tabpanel"
        aria-labelledby="kpis-info-beyond-renovacion-tab">

    </div>
    <div class="tab-pane fade" id="call-base de datos-info-renovacion" role="tabpanel"
        aria-labelledby="call-base de datos-info-renovacion-tab">
        <?= $this->render('_call-center/_database') ?>
    </div>
    <div class="tab-pane fade show active" id="kpis-info-beyond-renovacion" role="tabpanel"
        aria-labelledby="kpis-info-beyond-renovacion-tab">
        <?= $this->render('_call-center/_kpis') ?>
    </div>
</div>