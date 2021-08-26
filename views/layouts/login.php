<?php

/**
 * @var string $content
 * @var \yii\web\View $this
 */

use yii\helpers\Html;

app\assets\AppAsset::register($this);
?>
<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage"
        content="<?= Yii::getAlias('@web') ?>/assets/images/syn/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <link rel="apple-touch-icon" sizes="57x57"
        href="<?= Yii::getAlias('@web') ?>/assets/images/syn/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60"
        href="<?= Yii::getAlias('@web') ?>/assets/images/syn/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72"
        href="<?= Yii::getAlias('@web') ?>/assets/images/syn/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76"
        href="<?= Yii::getAlias('@web') ?>/assets/images/syn/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114"
        href="<?= Yii::getAlias('@web') ?>/assets/images/syn/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120"
        href="<?= Yii::getAlias('@web') ?>/assets/images/syn/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144"
        href="<?= Yii::getAlias('@web') ?>/assets/images/syn/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152"
        href="<?= Yii::getAlias('@web') ?>/assets/images/syn/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180"
        href="<?= Yii::getAlias('@web') ?>/assets/images/syn/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"
        href="<?= Yii::getAlias('@web') ?>/assets/images/syn/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32"
        href="<?= Yii::getAlias('@web') ?>/assets/images/syn/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96"
        href="<?= Yii::getAlias('@web') ?>/assets/images/syn/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16"
        href="<?= Yii::getAlias('@web') ?>/assets/images/syn/favicon/favicon-16x16.png">
    <link rel="manifest" href="<?= Yii::getAlias('@web') ?>/assets/images/syn/favicon/manifest.json">
</head>

<body class="hold-transition theme-primary bg-login">
    <?php $this->beginBody(); ?>
    <div class="container h-p100">
        <div class="row align-items-center justify-content-md-center h-p100">
            <div class="col-12">
                <div class="row justify-content-center no-gutters">
                    <div class="col-lg-5 col-md-5 col-12">
                        <div class="bg-white rounded10 shadow-lg container-login">
                            <div class="content-top-agile p-20 pb-0">
                                <img class="logo_ubbitt d-block m-auto"
                                    src="<?= Yii::getAlias('@web') ?>/assets/images/ubbitt_color.png" alt="logo"
                                    width="200">
                                <p class="mb-0 c-header">Ingresa tus datos para continuar.</p>
                            </div>
                            <div class="p-40 pt-10">
                                <form>
                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span
                                                    class="input-group-text bg-transparent border-right-0 brd-gray font-size-16">
                                                    <i class="icon-User"><span class="path1"></span><span
                                                            class="path2"></span></i>
                                                </span>
                                            </div>
                                            <input id="user" type="text"
                                                class="form-control pl-10 bg-transparent border-left-0 brd-gray"
                                                name="usuario" placeholder="Nombre de usuario">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span
                                                    class="input-group-text brd-gray bg-transparent border-right-0 font-size-16"><i
                                                        class="fa fa-lock"></i></span>
                                            </div>
                                            <input id="pass" type="password"
                                                class="form-control brd-gray pl-15 bg-transparent border-left-0"
                                                name="password" placeholder="Password">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 text-center pos-check">
                                            <div class="form-check p-0 prt-10">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="defaultCheck1">
                                                <label class="form-check-label" for="defaultCheck1">
                                                    <span class="font-size-14 c-gray">Acepto <a href="#"
                                                            class="c-terminos">Términos y Condiciones</a></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 text-center p-20 pb-0">
                                            <!-- <a href="clientes.php" class="btn btn-first mt-10 c-white font-weight-800 col-md-7 text-uppercase">iniciar sesión</a> -->
                                            <a href="dashboard-freemium.php"
                                                class="btn btn-first mt-10 c-white font-weight-800 col-md-7 text-uppercase">iniciar
                                                sesión</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="cambioPassword" tabindex="-1" role="dialog" aria-labelledby="cambioPasswordTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header border-0">
                </div>
                <div class="modal-body">
                    <div class="text-center p-25">
                        <h4 class="c-header font-weight-800">Ayuda con la contraseña</h4>
                        <p class="c-header">Introduce tu correo electrónico <br> para que un agente de RH pueda
                            modificar la contraseña</p>
                        <input type="text" class="col-10 m-auto">
                        <div class="col-12 text-center mt-20">
                            <button type="button" class="btn btn-first col-6 c-white font-weight-800"
                                data-dismiss="modal" data-toggle="modal" data-target="#cambioEnviado">Continuar</button>
                        </div>
                        <div class="col-12 text-center mt-20">
                            <button type="button" class="btn btn-second col-6 c-white font-weight-800"
                                data-dismiss="modal">Cancelar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="cambioEnviado" tabindex="-1" role="dialog" aria-labelledby="cambioEnviadoTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header border-0">
                </div>
                <div class="modal-body">
                    <div class="text-center p-25">
                        <h4 class="c-header font-weight-800">Tu solicitud se ha enviado exitosamente</h4>
                        <p class="c-header">En breve recibirás la nueva contraseña en tu correo electrónico</p>
                        <div class="col-12 text-center mt-20">
                            <button type="button" class="btn btn-first col-6 c-white font-weight-800"
                                data-dismiss="modal">Aceptar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Vendor JS -->
    <script src="<?= Yii::getAlias('@web') ?>/assets/js/vendors.min.js"></script>
    <script src="<?= Yii::getAlias('@web') ?>/assets/icons/feather-icons/feather.min.js"></script>
    <?php $this->endBody(); ?>
</body>

</html>
<?php $this->endPage(); ?>