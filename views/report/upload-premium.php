<?php
/* @var $this yii\web\View */

use app\models\db\Campaign;
use yii\web\View;

$this->registerJsFIle('@web/assets/js/views/report/upload-premium.js', ['position' => View::POS_END, 'depends' => [\app\assets\AppAsset::class]]);
?>
<div class="wid-100">
    <div class="h100 mt-50">
        <h3 class="c-header font-weight-bold text-center">Importa tus datos con Ubbitt</h3>
        <div class="col-md-6 mx-auto text-center div-white pt-15 pb-15 rounded mt-30">
            <img src="<?= Yii::getAlias('@web') ?>/assets/images/syn/file.png" alt="file">
            <div class="mt-4">
                <p class="c-header h3 font-weight-bold d-block">Importar</p>
                <p class="c-header">Importa información de contactos, negocios, tickets y productos a Ubbitt.</p>
                <form>
                    <div class="col-10 form-group">
                        <div class="col-12">
                            <label class="form-label" id="campaign-id-label" for="campaign-id">Seleccione la
                                campaña</label>
                        </div>
                        <div class="col-12">
                            <select id="campaign-id" class="form-control">
                                <?php
                                $userInfo = Yii::$app->session->get("userInfo");
                                $campaignModel = new Campaign();
                                $campaigns = $campaignModel->findByCompanyId($userInfo->companyId);
                                foreach ($campaigns as $campaign) {
                                ?>
                                <option value="<?= $campaign->campaignId ?>"><?= $campaign->name ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="custom-file col-10">
                        <label class="custom-file-label" id="file-input-label" for="file-input">Seleccione su
                            archivo</label>
                        <input id="file-input" type="file"
                            accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"
                            class="custom-file-input" name="file">
                        <i style="display: none;" id="msjFile1">Formato válido para los archivos: xslx, xsl.</i>
                        <i style="display: none;" id="msjFilePeso1">El peso máximo para el archivo es de: 2M</i>
                    </div>
                    <button id="btn-upload-file" class="btn btn-first c-white col-md-6 mt-15 mb-5">Subir</button>
                </form>
            </div>
        </div>
        <div id="result-table" class="table-responsive mt-30"></div>
        <pre id="result" hidden=""></pre>
    </div>
</div>