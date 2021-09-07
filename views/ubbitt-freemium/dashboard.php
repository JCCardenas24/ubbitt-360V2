<?php

/* @var $this yii\web\View */

use yii\web\View;

$this->title = 'Ubbitt 360';
\app\assets\ChartsAsset::register($this);
$this->registerJsFile('@web/assets/js/views/ubbitt-freemium/freemium-dashboard.js', ['position' => View::POS_END, 'depends' => [\app\assets\ChartsAsset::class]]);
?>
<div class="container container-beyond" id="dynamic-tabs">
    <?= $this->render('../_commons/_tabs/_plans.php') ?>
    <div class="tab-content" id="main_tabs_panelsContent">
        <div class="tab-pane fade show active" id="freemium_option" role="tabpanel"
            aria-labelledby="freemium_option-tab">
            <?= $this->render('_inbound', ['reportFileModel' => $reportFileModel]) ?>
        </div>

    </div>

</div>