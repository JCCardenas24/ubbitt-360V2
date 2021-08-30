<?php

/* @var $this yii\web\View */

use yii\helpers\Url;
?>
<ul class="nav nav-pills level_one level-one-beyond" id="main_tabs_panels" role="tablist">
    <li class="nav-item" role="presentation">
        <a class="nav-link active" id="beyond_option-tab" data-toggle="pill"
            href="<?= Url::toRoute(['ubbitt-beyond/renewal-dashboard']) ?>" role="tab" aria-controls="beyond_option"
            aria-selected="false">Ubbitt Beyond</a>
    </li>
    <li class="nav-item" role="presentation">
        <!-- <a class="nav-link" id="premium-tab" data-toggle="pill" href="#premium" role="tab"
                            aria-controls="premium" aria-selected="false">Ubbitt Premium</a> -->
        <a class="nav-link" id="premium-tab">Ubbitt Premium</a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link " id="freemium_option-tab" href="<?= Url::toRoute(['ubbitt-freemium/dashboard']) ?>">Ubbitt
            Freemium</a>
    </li>
</ul>