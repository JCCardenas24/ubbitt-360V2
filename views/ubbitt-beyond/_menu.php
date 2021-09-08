<?php

/* @var $this yii\web\View */

use yii\helpers\Url;
?>
<ul class="nav nav-pills level_two" id="beyond-home" role="tablist">
    <li class="nav-item" role="presentation">
        <a class="nav-link <?= 'ubbitt-beyond/collection-dashboard' == Yii::$app->getRequest()->getPathInfo() ? 'active' : '' ?>"
            id="cobranza-home-tab"
            <?= 'ubbitt-beyond/collection-dashboard' == Yii::$app->getRequest()->getPathInfo() ? 'data-toggle="pill"' : '' ?>
            href="<?= Url::toRoute(['ubbitt-beyond/collection-dashboard']) ?>" role="tab" aria-controls="cobranza-home"
            aria-selected="true">Cobranza</a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link <?= 'ubbitt-beyond/renewal-dashboard' == Yii::$app->getRequest()->getPathInfo() ? 'active' : '' ?>"
            id="renovacion-home-tab"
            <?= 'ubbitt-beyond/renewal-dashboard' == Yii::$app->getRequest()->getPathInfo() ? 'data-toggle="pill"' : '' ?>
            href="<?= Url::toRoute(['ubbitt-beyond/renewal-dashboard']) ?>">Renovación</a>
    </li>
</ul>