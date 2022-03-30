<ul class="nav nav-pills level-three campaigns-1-options-tab" id="campaigns-1-options-tab" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="brief-campaign-<?= $campaignId ?>-tab" data-toggle="pill"
            href="#brief-campaign-<?= $campaignId ?>" role="tab" aria-controls="brief-campaign-<?= $campaignId ?>"
            aria-selected="true">Brief</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="resumen-campaign-<?= $campaignId ?>-tab" data-toggle="pill"
            href="#resumen-campaign-<?= $campaignId ?>" role="tab" aria-controls="resumen-campaign-<?= $campaignId ?>"
            aria-selected="false">Resumen</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="marketing-campaign-<?= $campaignId ?>-tab" data-toggle="pill"
            href="#marketing-campaign-<?= $campaignId ?>" role="tab"
            aria-controls="marketing-campaign-<?= $campaignId ?>" aria-selected="false">Marketing</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="call-center-campaign-<?= $campaignId ?>-tab" data-toggle="pill"
            href="#call-center-campaign-<?= $campaignId ?>" role="tab"
            aria-controls="call-center-campaign-<?= $campaignId ?>" aria-selected="false">Call Center</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="report-campaign-<?= $campaignId ?>-tab" data-toggle="pill"
            href="#report-campaign-<?= $campaignId ?>" role="tab"
            aria-controls="report-campaign-<?= $campaignId ?>" aria-selected="false">Reporte</a>
    </li>

    <li class="nav-item">
        <div class="d-flex balance_campaign_data">
            <!-- <div class="d-flex">
                <p>Inversión</p>
                <span> | </span>
                <small id="header-forecast-investment">$0</small>
            </div> -->
            <div class="d-flex">
                <p>Gasto</p>
                <span> | </span>
                <small id="header-spent-budget">$0</small>
            </div>
            <div class="d-flex">
                <p>Ventas</p>
                <span> | </span>
                <small id="header-actual-sales">$0</small>
            </div>
        </div>
    </li>
</ul>