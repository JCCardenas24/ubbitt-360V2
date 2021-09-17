<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
?>
<div id="reports_info_contents">
    <div class="d-flex wid-100 justify-content-end">
        <div class="col-5 d-flex justify-content-between">
            <div class="form-group wid-100 d-flex m-0">
                <div id="freemium-report-date-range" class="range-pick">
                    <i class="fa fa-calendar"></i>&nbsp;
                    <span class="text-date"></span>&nbsp;&nbsp;<i class="fa fa-caret-down"></i>
                </div>
            </div>
        </div>
        <a href="#" id="upload_report_btn" class="pdf_button"><i class="icon-agegarnuevo"></i></a>
    </div>
    <br>
    <?= $this->render('_kpis-detail/_kpis-table') ?>
</div>
<div id="view_upload_report_form" style="display: none;">
    <a id="cancel_upload_report" class="cancel_upload_report">
        < Regresar a la lista</a>
            <h3 class="c-header font-weight-bold text-center">Importa tus datos con UBBITT</h3>
            <div class="col-md-6 mx-auto text-center div-white pt-15 pb-15 rounded mt-30">
                <img src="<?= Yii::getAlias('@web') ?>/assets/images/syn/file.png" alt="file">
                <div class="mt-4">
                    <p class="c-header h3 font-weight-bold d-block">Importar</p>
                    <p class="c-header">Importa información de contactos, negocios, tickets y productos a Ubbitt.</p>
                    <?php $formUploadReport = ActiveForm::begin([
                        'id' => 'upload-report-form',
                        'fieldConfig' => [
                            'template' => "{input}{error}",
                            'options' => [
                                'tag' => false,
                            ],
                        ],
                        'action' => [Url::toRoute(['report-file/create'])],
                        'options' => [
                            'enctype' => 'multipart/form-data',
                            'method' => 'post'
                        ]
                    ]); ?>
                    <div class="custom-file col-10">
                        <label class="custom-file-label" id="nameFile1" for="f02">Seleccione su archivo</label>
                        <?= $formUploadReport->field($reportFileModel, 'file')->fileInput(['id' => 'reportFile', 'class' => 'custom-file-input', 'accept' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel']) ?>
                        <?= $formUploadReport->field($reportFileModel, 'module_origin')->hiddenInput(['id' => 'module-origin', 'value' => 'freemium']) ?>
                        <?= $formUploadReport->field($reportFileModel, 'submodule_origin')->hiddenInput(['id' => 'submodule-origin', 'value' => 'inbound']) ?>
                        <?= $formUploadReport->field($reportFileModel, 'type')->hiddenInput(['id' => 'type-file', 'value' => 'kpis']) ?>
                        <i style="display: none;" id="msjFile1">Formato válido para los archivos: xslx, xsl.</i>
                        <i style="display: none;" id="msjFilePeso1">El peso máximo para el archivo es de: 2M</i>
                    </div>
                    <?= Html::submitButton('Subir', ['class' => 'btn btn-first c-white col-md-6 mt-15 mb-5 upload_file_report']) ?>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
</div>