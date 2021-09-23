<div class="tab-content" id="campaigns-<?= $campaignId ?>-options-tabContent">
    <div class="tab-pane fade show active " id="brief-campaign-<?= $campaignId ?>" role="tabpanel"
        aria-labelledby="brief-campaign-<?= $campaignId ?>-tab">
        <?= $this->render('_content/_brief') ?>
    </div>
    <div class="tab-pane fade mt-60" id="resumen-campaign-<?= $campaignId ?>" role="tabpanel"
        aria-labelledby="resumen-campaign-<?= $campaignId ?>-tab">
        <?= $this->render('_content/_summary') ?>
    </div>
    <div class="tab-pane fade" id="marketing-campaign-<?= $campaignId ?>" role="tabpanel"
        aria-labelledby="marketing-campaign-<?= $campaignId ?>-tab">
        <?= $this->render('_content/_marketing') ?>
    </div>
    <div class="tab-pane fade" id="call-center-campaign-<?= $campaignId ?>" role="tabpanel"
        aria-labelledby="call-center-campaign-<?= $campaignId ?>-tab">
        <?= $this->render('_content/_call-center') ?>
    </div>
</div>