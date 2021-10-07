<?php

/* @var $this yii\web\View */

use app\models\db\Campaign;
use app\models\db\UserInfo;
use yii\helpers\Url;
?>
<ul class="nav nav-pills level_one level-one-beyond" id="main_tabs_panels" role="tablist">
    <?php if (in_array('menu_ubbitt_beyond', Yii::$app->session->get("userPermissions"))) { ?>
    <li class="nav-item" role="presentation">
        <a class="nav-link <?= Yii::$app->controller->id == 'ubbitt-beyond' ? 'active' : '' ?>" id="beyond_option-tab"
            href="<?= Url::toRoute(['ubbitt-beyond/collection-dashboard']) ?>">Ubbitt Beyond</a>
    </li>
    <?php } ?>
    <?php
    if (in_array('menu_ubbitt_premium', Yii::$app->session->get("userPermissions"))) {
        $userId = Yii::$app->session->get("userIdentity")->user_id;
        $userInfo = UserInfo::findById($userId);
        $campaignModel = new Campaign();
        $campaigns = $campaignModel->findByCompanyId($userInfo->companyId);
        $campaignId = count($campaigns) > 0 ? $campaigns[0]->campaignId : null;
    ?>
    <li class="nav-item" role="presentation">
        <a class="nav-link <?= Yii::$app->controller->id == 'ubbitt-premium' ? 'active' : '' ?>" id="premium-tab"
            href="<?= Url::toRoute(['ubbitt-premium/dashboard', 'id' => ($campaignId)]) ?>">Ubbitt
            Premium</a>
    </li>
    <?php } ?>
    <?php
    if (in_array('menu_ubbitt_freemium', Yii::$app->session->get("userPermissions"))) {
    ?>
    <li class="nav-item" role="presentation">
        <a class="nav-link <?= Yii::$app->controller->id == 'ubbitt-freemium' ? 'active' : '' ?>"
            id="freemium_option-tab" href="<?= Url::toRoute(['ubbitt-freemium/dashboard']) ?>">Ubbitt
            Freemium</a>
    </li>
    <?php } ?>
</ul>