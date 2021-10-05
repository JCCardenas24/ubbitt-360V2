<?= $this->render('_call-center/_options') ?>
<div class="tab-content" id="premium-call-center-campaign-1-options-content-tabContent">
    <div class="tab-pane fade show active" id="premium-call-center-kpis-campaign-1-content" role="tabpanel"
        aria-labelledby="premium-call-center-kpis-campaign-1-content-tab">
        <?= $this->render('_call-center/_kpis') ?>
    </div>
    <div class="tab-pane fade" id="premium-call-center-bd-llamadas-campaign-1-content" role="tabpanel"
        aria-labelledby="premium-call-center-bd-llamadas-campaign-1-content-tab">
        <?= $this->render('_call-center/_database-calls') ?>
    </div>
    <div class="tab-pane fade" id="premium-call-center-bd-sales-campaign-1-content" role="tabpanel"
        aria-labelledby="premium-call-center-bd-sales-campaign-1-content-tab">
        <?= $this->render('_call-center/_database-sales') ?>
    </div>
</div>