<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */

?>
<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-profile px-20 py-15">
            <div class="d-flex align-items-center">
                <div class="image d-flex justify-content-center align-items-center">
                    <span id="letterSpace" class="font-size-30 font-weight-700 c-sky">U</span>
                </div>
                <div class="info">
                    <span class="px-20 font-size-14 font-weight-900 c-white">Ubbitt - Admin</span><br>
                    <span class="px-20 font-size-12 c-white">Administrador</span>
                </div>
            </div>
        </div>
        <div class="menu-sidebar">
            <div id="accordion">
                <?php
                if (in_array('menu_ubbitt_freemium', Yii::$app->session->get("userPermissions"))) {
                ?>
                <div class="views_menu_option">
                    <div class="" id="headingOne">
                        <h5 class="mb-0">
                            <a class="header_ttl" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
                                aria-controls="collapseOne">
                                <span>
                                    <i class="ri-pie-chart-fill"></i>
                                    Ubbitt Freemium
                                </span>
                                <i class="ri-arrow-right-s-line"></i>
                            </a>
                        </h5>
                    </div>
                    <?php
                        if (in_array('menu_ubbitt_freemium_inbound', Yii::$app->session->get("userPermissions"))) {
                        ?>
                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                        <li class="sub_ttl">
                            <?= Html::a("Inbound", Url::toRoute(['ubbitt-freemium/dashboard', '#' => 'freemium-inbound'])) ?>
                        </li>
                        <ul>
                            <li><span id="li_resumen_inbound_freemium" class="options_inbound_freemium">Resumen</span>
                            </li>
                            <li><span id="li_call_center_inbound_freemium" class="options_inbound_freemium">Call
                                    Center</span></li>
                            <li><span id="li_reportes_inbound_freemium" class="options_inbound_freemium">Reportes</span>
                            </li>
                        </ul>
                    </div>
                    <?php } ?>
                </div>
                <?php } ?>
                <?php
                if (in_array('menu_ubbitt_premium', Yii::$app->session->get("userPermissions"))) {
                ?>
                <div class="views_menu_option">
                    <div class="" id="headingOne">
                        <h5 class="mb-0">
                            <a class="header_ttl collapsed" data-toggle="collapse" data-target="#collapse_premium"
                                aria-expanded="false" aria-controls="collapse_premium">
                                <span><i class="ri-pie-chart-fill"></i>
                                    Ubbitt Premium</span>
                                <i class="ri-arrow-right-s-line"></i>
                            </a>
                        </h5>
                    </div>

                    <div id="collapse_premium" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                    </div>
                </div>
                <?php }
                ?>
                <?php
                if (in_array('menu_ubbitt_beyond', Yii::$app->session->get("userPermissions"))) {
                ?>
                <div class="views_menu_option">
                    <div class="" id="headingTwo">
                        <h5 class="mb-0">
                            <a class="header_ttl collapsed" data-toggle="collapse" data-target="#collapseTwo"
                                aria-expanded="false" aria-controls="collapseTwo">
                                <span>
                                    <i class="ri-pie-chart-fill"></i>
                                    Ubbitt Beyond
                                </span>
                                <i class="ri-arrow-right-s-line"></i>
                            </a>
                        </h5>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                        <?php
                            if (in_array('menu_ubbitt_beyond_collection', Yii::$app->session->get("userPermissions"))) {
                            ?>
                        <li class="sub_ttl" id="beyond-collection-call-center-tab"><a
                                href="<?= Url::toRoute(['ubbitt-beyond/collection-dashboard']) ?>">Cobranza</a></li>
                        <ul>
                            <li><span>Resumen</span></li>
                            <li><span>Call Center</span></li>
                            <li><span>Reportes</span></li>
                            <li><span>Carga de base de datos</span></li>
                        </ul>
                        <?php } ?>
                        <?php
                            if (in_array('menu_ubbitt_beyond_renewal', Yii::$app->session->get("userPermissions"))) {
                            ?>
                        <li class="sub_ttl"><a
                                href="<?= Url::toRoute(['ubbitt-beyond/renewal-dashboard']) ?>">Renovación</a></li>
                        <ul>
                            <li><span>Resumen</span></li>
                            <li><span>Call Center</span></li>
                            <li><span>Reportes</span></li>
                            <li><span>Carga de base de datos</span></li>
                        </ul>
                        <?php } ?>
                    </div>
                </div>
                <?php } ?>
                <div class="views_menu_option">
                    <div class="" id="headingThree">
                        <h5 class="mb-0">
                            <a class="header_ttl collapsed" data-toggle="collapse" data-target="#collapseThree"
                                aria-expanded="false" aria-controls="collapseThree">
                                <span>
                                    <i class="ri-user-3-fill"></i>
                                    Cuenta
                                </span>
                                <i class="ri-arrow-right-s-line"></i>
                            </a>
                        </h5>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                        <ul class="mt-3">
                            <li class="cuenta"><span><a href="<?= Url::toRoute(['account/profile']) ?>">Mis
                                        datos</a></span></li>
                            <li class="cuenta"><span><a href="<?= Url::toRoute(['login/logout']) ?>">Cerrar
                                        sesión</a></span></li>
                        </ul>
                    </div>
                </div>
                <?php
                if (in_array('menu_upload_report', Yii::$app->session->get("userPermissions"))) {
                ?>
                <div class="views_menu_option">
                    <div class="" id="headingFour">
                        <h5 class="mb-0">
                            <a class="header_ttl collapsed" href="<?= Url::toRoute(['report/upload']) ?>">
                                <span>
                                    <i class="ri-upload-cloud-2-fill"></i>
                                    Carga de reporte
                                </span>
                            </a>
                        </h5>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>

        <div class="icons_collapsed">
            <i class="ri-pie-chart-fill"></i>
            <i class="ri-pie-chart-fill"></i>
            <i class="ri-pie-chart-fill"></i>
            <i class="ri-user-3-fill"></i>
        </div>

    </section>
</aside>