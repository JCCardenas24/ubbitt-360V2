<?php

use app\models\db\Campaign;
use yii\helpers\Url;

?>
<ul class="nav nav-pills level_two" id="campaigns-tab" role="tablist">
    <?php
    $userInfo = Yii::$app->session->get("userInfo");
    $campaignModel = new Campaign();
    $campaigns = $campaignModel->findByCompanyId($userInfo->companyId);
    foreach ($campaigns as $campaign) {
    ?>
    <li class="nav-item">
        <a class="nav-link<?= $campaignId == $campaign->campaignId ? ' active' : '' ?>"
            id="campaigns-<?= $campaign->campaignId ?>-tab"
            href="<?= Url::to(['ubbitt-premium/dashboard', 'id' => $campaign->campaignId, '#' => 'brief-campaign']) ?>"
            style="width: 135px;"><?= $campaign->name ?></a>
    </li>
    <?php } ?>
</ul>