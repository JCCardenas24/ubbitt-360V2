<!-- <div>
    <div id="tab-llamadas_kpis">
        <table id="llamadas_kpis-table" class="display general-table" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre Archivo</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Acciones</th>
                </tr>
            </thead>
        </table>
    </div>
</div> -->

<!-- <div class="d-flex mb-20">
    <div class="d-flex wid-100 justify-content-end">
        <div class="col-4 d-flex justify-content-between">
            <div class="form-group wid-100 d-flex m-0">
                <div id="reportrange_clientes" class="range-pick">
                    <i class="fa fa-calendar"></i>&nbsp;
                    <span></span>&nbsp;&nbsp;<i class="fa fa-caret-down"></i>
                </div>
            </div>
        </div>
        <a href="#" class="pdf_button mr-5"><i class="ri-file-list-2-line"></i></a>
        <a href="#" class="pdf_button"><i class="ri-file-list-2-line"></i></a>
    </div>
</div> -->

<?= $this->render('_kpis-detail/_kpis-table') ?>