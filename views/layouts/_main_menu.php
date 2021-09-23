<?php

use app\models\db\Campaign;
use app\models\db\UserInfo;
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
                    <span
                        class="px-20 font-size-12 c-white"><?= ucwords(Yii::$app->session->get("userInfo")->name) ?></span>
                </div>
            </div>
        </div>
        <!-- sidebar menu-->
        <ul class="sidebar-menu" data-widget="tree">
            <!-- Ubbitt Freemium -->
            <?php
            if (in_array('menu_ubbitt_freemium', Yii::$app->session->get("userPermissions"))) {
            ?>
            <li class="treeview <?= Yii::$app->controller->id == 'ubbitt-freemium' ? 'menu-open' : '' ?>">
                <a href="#" class="wrapper_main_ttl_view">
                    <i class="ri-pie-chart-2-fill"><span class="path1"></span><span class="path2"></span></i>
                    <!-- <i class="icon-Write"></i> -->
                    <span class="main_ttl_view">Ubbitt Freemium</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu"
                    style="<?= Yii::$app->controller->id == 'ubbitt-freemium' ? 'display: block;' : '' ?>">
                    <?php
                        if (in_array('menu_ubbitt_freemium_inbound', Yii::$app->session->get("userPermissions"))) {
                        ?>
                    <li>
                        <?= Html::a('<i class="icon-Commit c-transparent"><span
                                    class="path1"></span><span class="path2"></span></i>Inbound', Url::toRoute(['ubbitt-freemium/dashboard', '#' => 'freemium-inbound-resumen-tab']), ['class' => 'li_first_level' . (Yii::$app->controller->id == 'ubbitt-freemium' ? ' current' : '')]) ?>
                    </li>
                    <?php } ?>
                    <?php
                        if (in_array('menu_ubbitt_freemium_inbound_summary', Yii::$app->session->get("userPermissions"))) {
                        ?>
                    <li>
                        <?= Html::a('<i
                                class="icon-Commit c-transparent"><span class="path1"></span><span
                                    class="path2"></span></i>Resumen', Url::toRoute(['ubbitt-freemium/dashboard', '#' => 'freemium-inbound-resumen-tab']), ['id' => 'freemium-inbound-resumen_side_menu', 'class' => 'li_second_level side-menu-link-redirect']) ?>
                    </li>
                    <?php } ?>
                    <?php
                        if (in_array('menu_ubbitt_freemium_inbound_call_center', Yii::$app->session->get("userPermissions"))) {
                        ?>
                    <li>
                        <?= Html::a('<i
                                class="icon-Commit c-transparent"><span class="path1"></span><span
                                    class="path2"></span></i>Call Center', Url::toRoute(['ubbitt-freemium/dashboard', '#' => 'freemium-inbound-call-center-tab']), ['id' => 'freemium-inbound-call-center_side_menu', 'class' => 'li_second_level side-menu-link-redirect']) ?>
                    </li>
                    <?php } ?>
                    <?php
                        if (in_array('menu_ubbitt_freemium_inbound_reports', Yii::$app->session->get("userPermissions"))) {
                        ?>
                    <li>
                        <?= Html::a('<i
                                class="icon-Commit c-transparent"><span class="path1"></span><span
                                    class="path2"></span></i>Reportes', Url::toRoute(['ubbitt-freemium/dashboard', '#' => 'freemium-inbound-reportes-tab']), ['id' => 'freemium-inbound-reportes_side_menu', 'class' => 'li_second_level side-menu-link-redirect']) ?>
                    </li>
                    <?php } ?>
                </ul>
            </li>
            <?php } ?>
            <!-- Ubbitt Premium -->
            <?php
            if (in_array('menu_ubbitt_premium', Yii::$app->session->get("userPermissions"))) {
            ?>
            <li class="treeview <?= Yii::$app->controller->id == 'ubbitt-premium' ? 'menu-open' : '' ?>">
                <a href="#" class="wrapper_main_ttl_view">
                    <i class="ri-pie-chart-2-fill"><span class="path1"></span><span class="path2"></span></i>
                    <span class="main_ttl_view">Ubbitt Premium</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu" style="display: block;">
                    <?php
                        $userInfo = Yii::$app->session->get("userInfo");
                        $campaignModel = new Campaign();
                        $campaigns = $campaignModel->findByCompanyId($userInfo->companyId);
                        foreach ($campaigns as $campaign) {
                        ?>
                    <li><a href="<?= Url::to(['ubbitt-premium/dashboard', 'id' => $campaign->campaignId, '#' => 'brief-campaign-' . $campaign->campaignId . '-tab']) ?>"
                            class="li_first_level<?= Yii::$app->controller->id == 'ubbitt-premium' && Yii::$app->request->get('id') == $campaign->campaignId ? ' current' : '' ?>"><i
                                class="icon-Commit c-transparent"><span class="path1"></span><span
                                    class="path2"></span></i><?= $campaign->name ?></a></li>
                    <li><a id="brief-campaign-<?= $campaign->campaignId ?>_side_menu"
                            href="<?= Url::to(['ubbitt-premium/dashboard', 'id' => $campaign->campaignId, '#' => 'brief-campaign-' . $campaign->campaignId . '-tab']) ?>"
                            class="li_second_level side-menu-link-redirect<?= Yii::$app->controller->id == 'ubbitt-premium' && Yii::$app->request->get('id') == $campaign->campaignId ? ' font-weight-bold' : '' ?>"><i
                                class="icon-Commit c-transparent"><span class="path1"></span><span
                                    class="path2"></span></i>Brief</a></li>
                    <li><a id="resumen-campaign-<?= $campaign->campaignId ?>_side_menu"
                            href="<?= Url::to(['ubbitt-premium/dashboard', 'id' => $campaign->campaignId, '#' => 'resumen-campaign-' . $campaign->campaignId . '-tab']) ?>"
                            class="li_second_level side-menu-link-redirect"><i class="icon-Commit c-transparent"><span
                                    class="path1"></span><span class="path2"></span></i>Resumen</a></li>
                    <li><a id="marketing-campaign-<?= $campaign->campaignId ?>_side_menu"
                            href="<?= Url::to(['ubbitt-premium/dashboard', 'id' => $campaign->campaignId, '#' => 'marketing-campaign-' . $campaign->campaignId . '-tab']) ?>"
                            class="li_second_level side-menu-link-redirect"><i class="icon-Commit c-transparent"><span
                                    class="path1"></span><span class="path2"></span></i>Marketing</a></li>
                    <li><a id="call-center-campaign-<?= $campaign->campaignId ?>_side_menu"
                            href="<?= Url::to(['ubbitt-premium/dashboard', 'id' => $campaign->campaignId, '#' => 'call-center-campaign-' . $campaign->campaignId . '-tab']) ?>"
                            class="li_second_level side-menu-link-redirect"><i class="icon-Commit c-transparent"><span
                                    class="path1"></span><span class="path2"></span></i>Call Center</a></li>
                    <br>
                    <?php } ?>
                </ul>
            </li>
            <?php } ?>
            <!-- Ubbitt Beyond -->
            <?php
            if (in_array('menu_ubbitt_beyond', Yii::$app->session->get("userPermissions"))) {
            ?>
            <li class="treeview <?= Yii::$app->controller->id == 'ubbitt-beyond' ? 'menu-open' : '' ?>">
                <a href="#" class="wrapper_main_ttl_view">
                    <i class="ri-pie-chart-2-fill"><span class="path1"></span><span class="path2"></span></i>
                    <!-- <i class="icon-Write"></i> -->
                    <span class="main_ttl_view">Ubbitt Beyond</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu"
                    style="<?= Yii::$app->controller->id == 'ubbitt-beyond' ? 'display: block;' : '' ?>">
                    <?php
                        if (in_array('menu_ubbitt_beyond_collection', Yii::$app->session->get("userPermissions"))) {
                        ?>
                    <li>
                        <?= Html::a('<i class="icon-Commit c-transparent"><span
                                    class="path1"></span><span class="path2"></span></i>Cobranza', Url::toRoute(['ubbitt-beyond/collection-dashboard', '#' => 'resumen-cobranza-tab']), ['class' => 'li_first_level' . (Url::current() == '/ubbitt-beyond/collection-dashboard' ? ' current' : '')]) ?>
                    </li>
                    <li>
                        <?= Html::a('<i
                                class="icon-Commit c-transparent"><span class="path1"></span><span
                                class="path2"></span></i>Resumen', Url::toRoute(['ubbitt-beyond/collection-dashboard', '#' => 'resumen-cobranza-tab']), ['id' => 'resumen-cobranza_side_menu', 'class' => 'li_second_level side-menu-link-redirect']) ?>
                    </li>
                    <li>
                        <?= Html::a('<i
                                class="icon-Commit c-transparent"><span class="path1"></span><span
                                    class="path2"></span></i>Call Center', Url::toRoute(['ubbitt-beyond/collection-dashboard', '#' => 'beyond-cobranza-callcenter-tab']), ['id' => 'beyond-cobranza-callcenter_side_menu', 'class' => 'li_second_level side-menu-link-redirect']) ?>
                    </li>
                    <li>
                        <?= Html::a('<i
                                class="icon-Commit c-transparent"><span class="path1"></span><span
                                    class="path2"></span></i>Reportes', Url::toRoute(['ubbitt-beyond/collection-dashboard', '#' => 'beyond-cobranza-reportes-tab']), ['id' => 'beyond-cobranza-reportes_side_menu', 'class' => 'li_second_level side-menu-link-redirect']) ?>
                    </li>
                    <li>
                        <?= Html::a('<i
                                class="icon-Commit c-transparent"><span class="path1"></span><span
                                    class="path2"></span></i>Carga de base de datos', Url::toRoute(['ubbitt-beyond/collection-dashboard', '#' => 'beyond-cobranza-carga-base-datos-tab']), ['id' => 'beyond-cobranza-carga-base-datos_side_menu', 'class' => 'li_second_level side-menu-link-redirect']) ?>
                    </li>
                    <?php } ?>
                    <?php
                        if (in_array('menu_ubbitt_beyond_renewal', Yii::$app->session->get("userPermissions"))) {
                        ?>
                    <li>
                        <?= Html::a('<i class="icon-Commit c-transparent"><span
                                    class="path1"></span><span class="path2"></span></i>Renovación', Url::toRoute(['ubbitt-beyond/renewal-dashboard', '#' => 'resumen-renovacion-tab']), ['class' => 'li_first_level' . (Url::current() == '/ubbitt-beyond/renewal-dashboard' ? ' current' : '')]) ?>
                    </li>
                    <li>
                        <?= Html::a('<i
                                class="icon-Commit c-transparent"><span class="path1"></span><span
                                class="path2"></span></i>Resumen', Url::toRoute(['ubbitt-beyond/renewal-dashboard', '#' => 'resumen-renovacion-tab']), ['id' => 'resumen-renovacion_side_menu', 'class' => 'li_second_level side-menu-link-redirect']) ?>
                    </li>
                    <li>
                        <?= Html::a('<i
                                class="icon-Commit c-transparent"><span class="path1"></span><span
                                    class="path2"></span></i>Call Center', Url::toRoute(['ubbitt-beyond/renewal-dashboard', '#' => 'beyond-renovacion-callcenter-tab']), ['id' => 'beyond-renovacion-callcenter_side_menu', 'class' => 'li_second_level side-menu-link-redirect']) ?>
                    </li>
                    <li>
                        <?= Html::a('<i
                                class="icon-Commit c-transparent"><span class="path1"></span><span
                                    class="path2"></span></i>Reportes', Url::toRoute(['ubbitt-beyond/renewal-dashboard', '#' => 'beyond-renovacion-reportes-tab']), ['id' => 'beyond-renovacion-reportes_side_menu', 'class' => 'li_second_level side-menu-link-redirect']) ?>
                    </li>
                    <li>
                        <?= Html::a('<i
                                class="icon-Commit c-transparent"><span class="path1"></span><span
                                    class="path2"></span></i>Carga de base de datos', Url::toRoute(['ubbitt-beyond/renewal-dashboard', '#' => 'beyond-renovacion-carga-base-datos-tab']), ['id' => 'beyond-renovacion-carga-base-datos_side_menu', 'class' => 'li_second_level side-menu-link-redirect']) ?>
                    </li>
                    <?php } ?>
                </ul>
            </li>
            <?php } ?>
            <hr>
            <!-- Account -->
            <li class="treeview <?= Yii::$app->controller->id == 'account' ? 'menu-open' : '' ?>">
                <a href="#" class="wrapper_main_ttl_view">
                    <i class="ri-user-3-fill"><span class="path1"></span><span class="path2"></span></i>
                    <!-- <i class="icon-Write"></i> -->
                    <span class="main_ttl_view">Cuenta</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu"
                    style="<?= Yii::$app->controller->id == 'account' ? 'display: block;' : '' ?>">
                    <li><a href="<?= Url::toRoute(['account/profile']) ?>"
                            class="li_second_level <?= Url::current() == '/account/profile' ? 'font-weight-bold' : '' ?>"
                            id="cuenta_side_menu"><i class="icon-Commit c-transparent"><span class="path1"></span><span
                                    class="path2"></span></i>Mis datos</a></li>
                    <li><a href="<?= Url::toRoute(['login/logout']) ?>" class="li_second_level"><i
                                class="icon-Commit c-transparent"><span class="path1"></span><span
                                    class="path2"></span></i>Cerrar sesión</a></li>


                </ul>
            </li>
            <!-- Report Upload -->
            <?php
            if (in_array('menu_upload_report', Yii::$app->session->get("userPermissions"))) {
            ?>
            <li>
                <a href="<?= Url::toRoute(['report/upload']) ?>"
                    class="wrapper_main_ttl_view <?= Url::current() == '/report/upload' ? 'font-weight-bold' : '' ?>">
                    <i
                        class="ri-upload-cloud-2-fill <?= Url::current() == '/report/upload' ? 'font-weight-bold' : '' ?>"><span
                            class="path1"></span><span class="path2"></span></i>
                    <span class="main_ttl_view">Carga de reporte</span>
                </a>
            </li>
            <?php } ?>
            <!-- Report Upload -->
            <?php
            if (in_array('menu_upload_premium_report', Yii::$app->session->get("userPermissions"))) {
            ?>
            <li>
                <a href="<?= Url::toRoute(['report/upload-premium']) ?>"
                    class="wrapper_main_ttl_view <?= Url::current() == '/report/upload-premium' ? 'font-weight-bold' : '' ?>">
                    <i
                        class="ri-upload-cloud-2-fill <?= Url::current() == '/report/upload-premium' ? 'font-weight-bold' : '' ?>"><span
                            class="path1"></span><span class="path2"></span></i>
                    <span class="main_ttl_view">Carga de reporte Premium</span>
                </a>
            </li>
            <?php } ?>
        </ul>
    </section>
</aside>