<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\ActiveForm;

$this->title = 'Ubbitt 360';
$this->registerJsFile('@web/assets/js/views/login/index.js', ['position' => View::POS_END, 'depends' => [\app\assets\LoginAsset::class]]);
$this->registerJsFile('@web/assets/js/vendors.min.js', ['position' => View::POS_END, 'depends' => [\app\assets\LoginAsset::class]]);
$this->registerJsFile('@web/assets/js/common/alert.js', ['position' => View::POS_END, 'depends' => [\app\assets\LoginAsset::class]]);
$this->registerCssFile('@web/assets/css/views/login/login.css', ['position' => View::POS_HEAD, 'depends' => [\app\assets\LoginAsset::class]]);
?>
<div class="container h-p100">
    <div class="row align-items-center justify-content-md-center h-p100">
        <div class="col-12">
            <div class="row justify-content-center no-gutters">
                <div class="col-lg-5 col-md-5 col-12">
                    <div id="login_container" class="bg-white rounded10 shadow-lg container-login">
                        <div>
                            <div class="content-top-agile">
                                <img class="logo_ubbitt d-block m-auto"
                                    src="<?= Yii::getAlias('@web') ?>/assets/images/ubbitt_color.svg" alt="logo"
                                    width="200">
                                <p class="mb-0 c-header">Ingresa tus datos para continuar.</p>
                            </div>
                            <?php $form = ActiveForm::begin([
                                'id' => 'login-form',
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
                                            <i class="icon-User"><span class="path1"></span><span
                                                    class="path2"></span></i>
                                        </span>
                                    </div>
                                    <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'id' => 'user', 'class' => 'form-control pl-10 bg-transparent border-left-0 brd-gray', 'placeholder' => 'Nombre de usuario']) ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span
                                            class="input-group-text brd-gray bg-transparent border-right-0 font-size-16"><i
                                                class="fa fa-lock"></i></span>
                                    </div>
                                    <?= $form->field($model, 'password')->passwordInput(['id' => 'pass', 'class' => 'form-control brd-gray pl-15 bg-transparent border-left-0', 'placeholder' => 'Password']) ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 text-center pos-check">
                                    <div class="form-check p-0 prt-10 pt-10">
                                        <?= $form->field($model, 'termsConditions', [
                                            'template' => "{input}"
                                        ])->checkbox(['id' => 'defaultCheck1', 'class' => 'form-check-input', 'checked' => false, 'required' => true, 'label' => null], false) ?>
                                        <label class="form-check-label" for="defaultCheck1">
                                            <span class="font-size-14 c-gray">Acepto <a
                                                    href="<?= Url::toRoute(['terms-and-conditions/index']) ?>"
                                                    class="c-terminos">Términos y
                                                    Condiciones</a></span>
                                        </label>
                                    </div>
                                </div>
                                <?= Html::submitButton('iniciar
                                        sesión', ['id' => 'submit-login-form', 'class' => 'btn_login btn btn-first mt-10 c-white font-weight-800 col-md-7 text-uppercase d-block mx-auto', 'name' => 'login-button', 'disabled' => true]) ?>
                                <a id="btn_go_to_recover" class="wid-100  text-center d-block mx-auto">Olvidé mi
                                    contraseña</a>
                            </div>
                            <?php ActiveForm::end(); ?>
                        </div>
                    </div>
                    <div id="recovery_psw_container" style="display: none;">
                        <?php $formPasswordReset = ActiveForm::begin([
                            'id' => 'password-reset-form',
                            'fieldConfig' => [
                                'template' => "{input}{error}",
                                'options' => [
                                    'tag' => false,
                                ],
                            ],
                            'action' => [Url::toRoute(['password-reset/request-reset'])],
                            'options' => [
                                'class' => 'mt-10',

                            ]
                        ]); ?>
                        <div class="recovery_step_1">
                            <h5>Recuperar contraseña</h5>
                            <p>Ingresa tu correo electrónico y se te enviará un link para reestabecer tu contraseña
                            </p>
                            <div class="form-group">
                                <label for="email_recovery_input">Email</label>
                                <?= $formPasswordReset->field($modelPasswordReset, 'email')->textInput(['id' => 'email_recovery_input', 'class' => 'form-control email_input', 'placeholder' => 'test@gmail.com']) ?>
                            </div>
                            <?= Html::submitButton('Enviar', ['class' => 'send_request_email']) ?>
                            <a class="cancel_request_email">Cancelar</a>
                        </div>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
                <?php $this->beginBlock('resetFormMessage'); ?>
                <?= $this->render('/_commons/_widgets/_toast') ?>
                <?php if (Yii::$app->session->hasFlash('success-reset')) { ?>
                <script>
                $(() => {
                    showAlert('success', "<?= Yii::$app->session->getFlash('success-reset') ?>");
                });
                </script>
                <?php } ?>
                <?php if (Yii::$app->session->hasFlash('reset-form-errors')) : ?>
                <script>
                $(() => {
                    var errors =
                        <?= json_encode(Yii::$app->session->getFlash('reset-form-errors'), JSON_UNESCAPED_UNICODE) ?>;
                    var error_txt = "";

                    for (const prop in errors) {
                        error_txt += errors[prop].join("<br>")
                    }

                    $('#login_container').toggle();
                    $('#recovery_psw_container').toggle();

                    showAlert('error', error_txt);
                });
                </script>
                <?php endif; ?>
                <?php $this->endBlock(); ?>
            </div>
        </div>
    </div>
</div>