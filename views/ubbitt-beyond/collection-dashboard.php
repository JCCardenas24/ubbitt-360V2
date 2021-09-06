<?php

/* @var $this yii\web\View */

use yii\web\View;

$this->title = 'Ubbitt 360';
\app\assets\ChartsAsset::register($this);
$this->registerJsFile('@web/assets/js/views/ubbitt-beyond/collection-dashboard.js', ['position' => View::POS_END, 'depends' => [\app\assets\ChartsAsset::class]]);
?>
<div class="container container-beyond" id="dynamic-tabs">
    <?= $this->render('../_commons/_tabs/_plans.php') ?>
    <div class="tab-content" id="main_tabs_panelsContent">
        <div class="tab-pane fade show active" id="beyond_option" role="tabpanel" aria-labelledby="beyond_option-tab">
            <?= $this->render('_menu') ?>
            <div class="tab-content" id="beyond-homeContent">
                <div class="tab-pane fade show active" id="cobranza-home" role="tabpanel"
                    aria-labelledby="cobranza-home-tab">
                    <?= $this->render('collection-dashboard/_submenu') ?>
                    <?= $this->render('collection-dashboard/_content') ?>
                </div>
            </div>
        </div>
    </div>
</div>