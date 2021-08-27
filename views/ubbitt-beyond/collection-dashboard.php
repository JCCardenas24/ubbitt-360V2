<?php

/* @var $this yii\web\View */

use yii\helpers\Url;
use yii\web\View;

$this->title = 'Ubbitt 360';
\app\assets\ChartsAsset::register($this);
$this->registerJsFIle('attets/js/beyond-cobranza-charts.js');
?>
<div class="container container-beyond" id="dynamic-tabs">
    <ul class="nav nav-pills level_one level-one-beyond" id="main_tabs_panels" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="beyond_option-tab" data-toggle="pill" href="#beyond_option" role="tab"
                aria-controls="beyond_option" aria-selected="false">Ubbitt Beyond</a>
        </li>

        <li class="nav-item" role="presentation">
            <!-- <a class="nav-link" id="premium-tab" data-toggle="pill" href="#premium" role="tab"
                            aria-controls="premium" aria-selected="false">Ubbitt Premium</a> -->
            <a class="nav-link" id="premium-tab">Ubbitt Premium</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link " id="freemium_option-tab"
                href="<?= Url::toRoute(['ubbitt-freemium/dashboard']) ?>">Ubbitt Freemium</a>
        </li>

    </ul>
    <div class="tab-content" id="main_tabs_panelsContent">
        <div class="tab-pane fade show active" id="beyond_option" role="tabpanel" aria-labelledby="beyond_option-tab">
            <?= $this->render('_menu') ?>
            <?= $this->render('collection-dashboard/_submenu') ?>
            <?= $this->render('collection-dashboard/_content') ?>
        </div>
    </div>

</div>