<div class="wid-100">
    <div class="h100 mt-50">
        <h3 class="c-header font-weight-bold text-center">Importa tus datos con Ubbitt</h3>
        <div class="col-md-6 mx-auto text-center div-white pt-15 pb-15 rounded mt-30">
            <img src="<?= Yii::getAlias('@web') ?>/assets/images/syn/file.png" alt="file">
            <div class="mt-4">
                <p class="c-header h3 font-weight-bold d-block">Importar</p>
                <p class="c-header">Importa información de contactos, negocios, tickets y productos a Ubbitt.</p>
                <form>
                    <div class="custom-file col-10">
                        <label class="custom-file-label" id="nameFile1" for="f02">Seleccione su archivo</label>
                        <input id="f02" type="file"
                            accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"
                            class="custom-file-input" name="file">
                        <i style="display: none;" id="msjFile1">Formato válido para los archivos: xslx, xsl.</i>
                        <i style="display: none;" id="msjFilePeso1">El peso máximo para el archivo es de: 2M</i>
                    </div>
                    <button class="btn btn-first c-white col-md-6 mt-15 mb-5">Subir</button>
                </form>
            </div>
        </div>
        <div id="result-table" class="table-responsive mt-30"></div>
        <pre id="result" hidden=""></pre>
    </div>
</div>