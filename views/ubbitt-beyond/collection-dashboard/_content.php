<div class="tab-content" id="cobranza-optionsContent">
    <div class="tab-pane fade show active" id="resumen-cobranza" role="tabpanel" aria-labelledby="resumen-cobranza-tab">
        <?= $this->render('_content/_summary') ?>
    </div>
    <div class="tab-pane fade" id="beyond-cobranza-callcenter" role="tabpanel"
        aria-labelledby="beyond-cobranza-callcenter-tab">
        <?= $this->render('_content/_call-center') ?>
    </div>
    <div class="tab-pane fade" id="beyond-cobranza-reportes" role="tabpanel"
        aria-labelledby="beyond-cobranza-reportes-tab">
        <?= $this->render('_content/_reports') ?>
    </div>
    <div class="tab-pane fade" id="beyond-cobranza-carga-base-datos" role="tabpanel"
        aria-labelledby="beyond-cobranza-carga-base-datos-tab">
        <?= $this->render('_content/_database-upload') ?>
    </div>
</div>