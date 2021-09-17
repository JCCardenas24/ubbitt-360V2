<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
?>
<div class="wid-100">
    <div class="h100 mt-50">
        <h3 class="c-header font-weight-bold text-center">Importa tus datos con Ubbitt</h3>
        <div class="col-md-6 mx-auto text-center div-white pt-15 pb-15 rounded mt-30">
            <img src="<?= Yii::getAlias('@web') ?>/assets/images/syn/file.png" alt="file">
            <div class="mt-4">
                <p class="c-header h3 font-weight-bold d-block">Importar</p>
                <p class="c-header">Importa información de contactos, negocios, tickets y productos a Ubbitt.</p>
                <?php $formDatabaseUpload = ActiveForm::begin([
                        'id' => 'upload-database-form',
                        'fieldConfig' => [
                            'template' => "{input}{error}",
                            'options' => [
                                'tag' => false,
                            ],
                        ],
                        'action' => [Url::toRoute(['ubbitt-beyond/upload-database'])],
                        'options' => [
                            'enctype' => 'multipart/form-data',
                            'method' => 'post'
                        ]
                    ]); ?>
                    <div class="custom-file col-10">
                        <label class="custom-file-label" id="nameFile1" for="f02">Seleccione su archivo</label>
                        <?= $formDatabaseUpload->field($databaseUploadModel, 'file')->fileInput(['id' => 'reportFile', 'class' => 'custom-file-input', 'accept' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel']) ?>
                        <?= $formDatabaseUpload->field($databaseUploadModel, 'module_origin')->hiddenInput(['id' => 'module-origin', 'value' => 'beyond']) ?>
                        <?= $formDatabaseUpload->field($databaseUploadModel, 'submodule_origin')->hiddenInput(['id' => 'submodule-origin', 'value' => 'collection']) ?>
                        <i style="display: none;" id="msjFile1">Formato válido para los archivos: xslx, xsl.</i>
                        <i style="display: none;" id="msjFilePeso1">El peso máximo para el archivo es de: 2M</i>
                    </div>
                    <?= Html::submitButton('Subir', ['class' => 'btn btn-first c-white col-md-6 mt-15 mb-5 upload_file_report']) ?>
                    <?php ActiveForm::end(); ?>
            </div>
        </div>
        <div id="result-table" class="table-responsive mt-30"></div>
        <pre id="result" hidden=""></pre>
    </div>
</div>