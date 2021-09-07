<?php

/* @var $this yii\web\View */

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
    ?>
    <li class="nav-item" role="presentation">
        <!-- <a class="nav-link" id="premium-tab" data-toggle="pill" href="#premium" role="tab"
                            aria-controls="premium" aria-selected="false">Ubbitt Premium</a> -->
        <a class="nav-link <?= Yii::$app->controller->id == 'ubbitt-premium' ? 'active' : '' ?>" id="premium-tab">Ubbitt
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