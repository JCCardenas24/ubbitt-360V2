<?php

/**
 * @var string $content
 * @var \yii\web\View $this
 */

use yii\helpers\Html;
use yii\helpers\Url;

app\assets\TermsAndConditionsAsset::register($this);
?>
<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?= Html::csrfMetaTags() ?>
    <title>Aviso de privacidad | Ubbitt 360</title>
    <?php $this->head() ?>
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

<body>
    <?php $this->beginBody() ?>
    <div class="container-fluid">
        <nav>
            <img class="logo" src="<?= Yii::getAlias('@web') ?>/assets/images/ubbitt_color.svg" alt="">

            <div class="d-flex align-items-center">
                <a href="<?= Url::toRoute(['login/index']) ?>" class="d-flex align-items-center">
                    <p class="m-0 ttl_iniciar_sesion">Iniciar sesión</p>
                    <div class="icon-user-wrapper">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20">
                            <path fill="none" d="M0 0h24v24H0z" />
                            <path fill="#BABCC3"
                                d="M20 22H4v-2a5 5 0 0 1 5-5h6a5 5 0 0 1 5 5v2zm-8-9a6 6 0 1 1 0-12 6 6 0 0 1 0 12z" />
                        </svg>
                    </div>
                </a>
            </div>
        </nav>

        <?= $content ?>

        <footer>
            <p>2021 Ubbitt 360 v2.0 | <span><a href="#">Aviso de privacidad</a></span> - <span><a href="#">Términos y
                        condiciones de uso de licencia</a></span></p>
        </footer>
    </div>
    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage(); ?>