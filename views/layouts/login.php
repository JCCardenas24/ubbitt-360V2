<?php

/**
 * @var string $content
 * @var \yii\web\View $this
 */

use yii\helpers\Html;

app\assets\LoginAsset::register($this);
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
    <?= $content ?>
    </div>
    <?php $this->endBody(); ?>
</body>

</html>
<?php $this->endPage(); ?>