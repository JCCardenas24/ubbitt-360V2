<?php

use yii\helpers\Url;

?>
<header class="main-header">
    <div class="d-flex align-items-center logo-box justify-content-between">
        <a href="#" class="waves-effect waves-light nav-link rounded d-none d-md-inline-block mx-10 push-btn c-yellow"
            data-toggle="push-menu" role="button">
            <span class="icon-Align-left"><span class="path1"></span><span class="path2"></span><span
                    class="path3"></span></span>
        </a>
        <a class="logo">
            <img src="<?= Yii::getAlias('@web') ?>/assets/images/ubbitt_blanco.png" alt="">
        </a>
    </div>
    <nav class="navbar navbar-static-top">
        <div class="container">
            <div class="app-menu">
                <ul class="header-megamenu nav">
                    <li class="btn-group nav-item d-md-none">
                        <a href="#" class="waves-effect waves-light nav-link rounded push-btn" data-toggle="push-menu"
                            role="button">
                            <span class="icon-Align-left"><span class="path1"></span><span class="path2"></span><span
                                    class="path3"></span></span>
                        </a>
                    </li>
                    <li>
                        <span id="encabezado" class="encabezado_ttl"><b>Mapfre</b> | Área</span>
                    </li>
                </ul>
            </div>
            <div class="navbar-custom-menu r-side p-0">
                <span>Hola, <?= ucwords(Yii::$app->session->get("userInfo")->name) ?></span>
                <ul class="nav navbar-nav">
                    <li class="dropdown user user-menu">
                        <a href="#"
                            class="waves-effect waves-light dropdown-toggle d-flex justify-content-center align-items-center"
                            data-toggle="dropdown" title="User">
                            <i class="ri-user-3-fill c-black"><span class="path1"></span><span class="path2"></span></i>
                        </a>
                        <ul class="dropdown-menu animated fadeIn">
                            <li class="user-body">
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item c-header" href="perfil.php"> Mi perfil</a>
                                <a class="dropdown-item c-header" href="<?= Url::toRoute(['login/logout'])  ?>"><i
                                        class="fa fa-sign-out mr-2"></i> Cerrar sesión</a>

                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <hr>
    </nav>
    <div class="modal fade" id="break" tabindex="-1" role="dialog" aria-labelledby="break" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="text-center">
                        <p class="c-header text-uppercase font-size-16 font-weight-800 mb-0">Selecciona una opción</p>
                        <p class="c-header font-size-14">Recuerda que una vez iniciado, la opción se bloqueará <br>
                            hasta el día siguiente.</p>
                    </div>
                    <div class="container row m-auto">
                        <div class="col-md-6 h-150">
                            <div id="cafe"
                                class="c-pointer option-break text-center bg-breaks h100 d-flex justify-content-center align-items-center">
                                <div>
                                    <img src="<?= Yii::getAlias('@web') ?>/assets/images/syn/cafe.svg" alt="cafe"
                                        width="60">
                                    <p class="c-header font-weight-900 mt-10 mb-0">Café. 10 min.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 h-150">
                            <div id="comida"
                                class="c-pointer option-break text-center bg-breaks h100 d-flex justify-content-center align-items-center">
                                <div>
                                    <img src="<?= Yii::getAlias('@web') ?>/assets/images/syn/eat.svg" alt="comida"
                                        width="60">
                                    <p class="c-header font-weight-900 mt-10 mb-0">Comida. 30 min.</p>
                                    <p class="c-red m-0 font-weight-300">(Restan 10 min)</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 h-150 mt-10">
                            <div id="restroom"
                                class="c-pointer option-break text-center bg-breaks h100 d-flex justify-content-center align-items-center">
                                <div>
                                    <img src="<?= Yii::getAlias('@web') ?>/assets/images/syn/rest.svg" alt="restroom"
                                        width="60">
                                    <p class="c-header font-weight-900 mt-10 mb-0">Sanitario (2). 5 min.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 h-150 mt-10">
                            <div id="descanso"
                                class="c-pointer option-break text-center bg-breaks h100 d-flex justify-content-center align-items-center">
                                <div>
                                    <img src="<?= Yii::getAlias('@web') ?>/assets/images/syn/sun.svg" alt="break"
                                        width="60">
                                    <p class="c-header font-weight-900 mt-10 mb-0">Break. 10 min.</p>
                                    <p class="c-red m-0 font-weight-300">Agotado</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 h-150 mt-10">
                            <div id="capacitacion"
                                class="c-pointer option-break text-center bg-breaks h100 d-flex justify-content-center align-items-center">
                                <div>
                                    <img src="<?= Yii::getAlias('@web') ?>/assets/images/syn/capacitacion.svg"
                                        alt="capacitacion" width="60">
                                    <p class="c-header font-weight-900 mt-10 mb-0">Capacitación. X min.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center p-10 pb-20">
                    <button type="button" class="btn btn-second col-4 mr-5 c-white font-weight-900"
                        data-dismiss="modal">Cancelar</button>
                    <button id="startTime" type="button" class="btn btn-first col-4 ml-5 c-white font-weight-900"
                        data-dismiss="modal">Iniciar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="recording" tabindex="-1" role="dialog" aria-labelledby="break" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <p class="mt-15 c-header font-size-14">Por medidas de seguridad, tu actividad será monitoreada por
                        medio de <br> la cámara web y pantalla de este equipo</p>
                    <div class="container row m-auto">
                        <div class="col-md-6 mt-20">
                            <img src="<?= Yii::getAlias('@web') ?>/assets/images/syn/record.png" alt="camera">
                        </div>
                        <div class="col-md-6 mt-20">
                            <img src="<?= Yii::getAlias('@web') ?>/assets/images/syn/screen.png" alt="screen">
                        </div>
                    </div>
                    <div class="pt-20 pb-0">
                        <p class="m-0 c-header font-weight-500">Has aceptado los <a class="ref" href="#">Términos y
                                condiciones</a></p>
                    </div>
                </div>
                <div class="text-center pb-20 mt-15 mb-15">
                    <button type="button" class="btn btn-first c-white font-weight-900 col-md-4"
                        data-dismiss="modal">Entendido</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalTime" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-time">
                <div class="modal-body pb-0 d-flex">
                    <div id="bodyBreak" class="container row m-auto p-20 pb-0">
                        <div class="col-md-3 text-center">
                            <img src="" alt="imgBreak" width="70">
                        </div>
                        <div class="col-md-9">
                            <div class="text-center mt-15">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pb-20 text-center">
                    <button type="button" class="btn btn-second col-md-3 mr-5 c-white font-weight-900"
                        data-dismiss="modal">Cerrar</button>
                    <button id="pause" type="button"
                        class="btn btn-first col-md-3 ml-5 c-white font-weight-900">Pausar</button>
                    <button id="resume" type="button"
                        class="btn btn-first col-md-3 ml-5 c-white font-weight-900 d-hide">Continuar</button>
                </div>
            </div>
        </div>
    </div>
</header>