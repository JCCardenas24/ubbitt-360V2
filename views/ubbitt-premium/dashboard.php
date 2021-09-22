<?php

/* @var $this yii\web\View */

use yii\web\View;

$this->title = 'Ubbitt 360';
\app\assets\ChartsAsset::register($this);
$this->registerJsFile('@web/assets/js/views/ubbitt-premium/dashboard.js', ['position' => View::POS_END, 'depends' => [\app\assets\ChartsAsset::class]]);
?>
<div class="container container-beyond" id="dynamic-tabs">
    <?= $this->render('../_commons/_tabs/_plans.php') ?>
    <div class="tab-content" id="main_tabs_panelsContent">
        <div class="tab-pane fade show active" id="premium" role="tabpanel" aria-labelledby="premium-tab">
            <?= $this->render('_menu', [
                'campaignId' => $campaignId
            ]) ?>
            <div class="tab-content" id="campaigns-tabContent">
                <div class="tab-pane fade show active" id="campaigns-1" role="tabpanel"
                    aria-labelledby="campaigns-1-tab">
                    <?= $this->render('_options', [
                        'campaignId' => $campaignId
                    ]) ?>
                    <?= $this->render('_content') ?>
                </div>
            </div>
        </div>
    </div>
</div>