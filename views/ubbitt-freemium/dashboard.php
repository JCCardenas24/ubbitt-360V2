<?php

/* @var $this yii\web\View */

use yii\web\View;

$this->title = 'Ubbitt 360';
\app\assets\ChartsAsset::register($this);
$this->registerJs('d3.json("/jsonData.json", function(error, json) {
                        treeBoxes("", json.tree);
                    });', View::POS_READY, 'web');
?>
<div class="container" id="dynamic-tabs">
    <ul class="nav nav-pills level_one" id="main_tabs_panels" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="freemium_option-tab" data-toggle="pill" href="#freemium_option" role="tab"
                aria-controls="freemium_option" aria-selected="true">Ubbitt Freemium</a>
        </li>
        <li class="nav-item" role="presentation">
            <!-- <a class="nav-link" id="premium-tab" data-toggle="pill" href="#premium" role="tab"
                            aria-controls="premium" aria-selected="false">Ubbitt Premium</a> -->
            <a class="nav-link" id="premium-tab">Ubbitt Premium</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="beyond_option-tab" href="dashboard-beyond-cobranza.php">Ubbitt Beyond</a>
        </li>
    </ul>
    <div class="tab-content" id="main_tabs_panelsContent">
        <div class="tab-pane fade show active" id="freemium_option" role="tabpanel"
            aria-labelledby="freemium_option-tab">
            <?= $this->render('_inbound') ?>
        </div>

    </div>

</div>