<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

$this->title = 'Ubbitt 360';
$this->registerJsFile('@web/assets/js/views/login/index.js', ['position' => View::POS_END, 'depends' => [\app\assets\LoginAsset::class]]);
$this->registerJsFile('@web/assets/js/views/password-reset/generate.js', ['position' => View::POS_END, 'depends' => [\app\assets\LoginAsset::class]]);
$this->registerJsFile('@web/assets/js/vendors.min.js', ['position' => View::POS_END, 'depends' => [\app\assets\LoginAsset::class]]);
$this->registerJsFile('@web/assets/js/common/alert.js', ['position' => View::POS_END, 'depends' => [\app\assets\LoginAsset::class]]);
?>
<div class="container h-p100">
    <div class="row align-items-center justify-content-md-center h-p100">
        <div class="col-12">
            <div class="row justify-content-center no-gutters">
                <div class="col-lg-5 col-md-5 col-12">
                    <div id="login_container" class="bg-white rounded10 shadow-lg container-login">
                        <div class="col-12">
                            <div class="content-top-agile">
                                <img class="logo_ubbitt d-block m-auto"
                                    src="<?= Yii::getAlias('@web') ?>/assets/images/ubbitt_color.svg" alt="logo"
                                    width="200">
                                <?php if ($isTokenValid) { ?>
                                <p class="mb-0 c-header">Ingresa tus datos para continuar.</p>
                                <?php } ?>
                            </div>
                            <?php if ($isTokenValid) { ?>
                            <?php $form = ActiveForm::begin([
                                    'id' => 'reset-password-form',
                                    'fieldConfig' => [
                                        'template' => "{input}{error}",
                                        'options' => [
                                            'tag' => false,
                                        ],
                                    ],
                                    'options' => [
                                        'class' => 'mt-10',
                                    ]
                                ]); ?>
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span
                                            class="input-group-text bg-transparent border-right-0 brd-gray font-size-16">
                                            <i class="fa fa-key"><span class="path1"></span><span
                                                    class="path2"></span></i>
                                        </span>
                                    </div>
                                    <?= $form->field($model, 'password')->passwordInput(['id' => 'password', 'class' => 'form-control brd-gray pl-15 bg-transparent border-left-0', 'placeholder' => 'Nueva contraseña']) ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span
                                            class="input-group-text brd-gray bg-transparent border-right-0 font-size-16"><i
                                                class="fa fa-check"></i></span>
                                    </div>
                                    <?= $form->field($model, 'password_confirm')->passwordInput(['id' => 'password_confirm', 'class' => 'form-control brd-gray pl-15 bg-transparent border-left-0', 'placeholder' => 'Confirmar nueva contraseña']) ?>
                                </div>
                            </div>
                            <div class="row">
                                <?= Html::submitButton('Continuar', ['id' => 'submit-reset-password-form', 'class' => 'btn_login btn btn-first mt-10 c-white font-weight-800 col-md-7 text-uppercase d-block mx-auto', 'name' => 'reset-password-button']) ?>
                            </div>
                            <?php ActiveForm::end(); ?>
                            <?php } else { ?>
                            <span>El token de recuperación de contraseña ha expirado o es inválido</span>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->beginBlock('resetFormMessage'); ?>
<?= $this->render('/_commons/_widgets/_toast') ?>
<?php if (Yii::$app->session->hasFlash('success-reset')) : ?>
<script>
showAlert('success', "<?= Yii::$app->session->getFlash('success-reset') ?>");
</script>
<?php endif; ?>
<?php if (Yii::$app->session->hasFlash('reset-form-errors')) : ?>
<script>
var errors = <?= json_encode(Yii::$app->session->getFlash('reset-form-errors'), JSON_UNESCAPED_UNICODE) ?>;
var error_txt = "";

for (const prop in errors) {
    error_txt += errors[prop].join("<br>")
}

$('#login_container').toggle();
$('#recovery_psw_container').toggle();

showAlert('error', error_txt);
</script>
<?php endif; ?>
<?php $this->endBlock(); ?>