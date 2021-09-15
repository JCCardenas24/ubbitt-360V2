<div class="tab-content" id="renovacion-optionsContent">
    <div class="tab-pane fade show active" id="beyond-renovacion-resumen" role="tabpanel"
        aria-labelledby="beyond-renovacion-resumen-tab">
        <?= $this->render('_content/_summary') ?>
    </div>
    <div class="tab-pane fade" id="beyond-renovacion-callcenter" role="tabpanel"
        aria-labelledby="beyond-renovacion-callcenter-tab">
        <?= $this->render('_content/_call-center') ?>
    </div>
    <div class="tab-pane fade" id="beyond-renovacion-reportes" role="tabpanel"
        aria-labelledby="beyond-renovacion-reportes-tab">
        <?= $this->render('_content/_reports', ['reportFileModel' => $reportFileModel]) ?>
    </div>
    <div class="tab-pane fade" id="beyond-renovacion-carga-base-datos" role="tabpanel"
        aria-labelledby="beyond-renovacion-carga-base-datos-tab">
        <?= $this->render('../../_commons/_plans/_database-upload') ?>
    </div>
</div>