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