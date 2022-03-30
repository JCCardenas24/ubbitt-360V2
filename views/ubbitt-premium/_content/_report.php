<table class="table table-hover" id="premium-reports-table">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Nombre de archivo</th>
            <th scope="col">Fecha</th>
            <th scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td scope="row">
                1
            </td>
            <td>
                Leads GdS Vf
            </td>
            <td>
                2022-01-12 17:35:25
            </td>
            <td>
                <a href="<?= Yii::getAlias('@web') ?>/assets/reportes/Leads_GdS_Vf.xlsx" download>
                    <i class="fa fa-download" aria-hidden="true"></i>
                </a>
            </td>
        </tr>
    </tbody>
</table>

<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-end" id="premium-reports-paginator">
        <li class="page-item disabled">
            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Anterior</a>
        </li>
        <li class="page-item"><a class="page-link" href="#">1</a></li>
        <li class="page-item disabled">
            <a class="page-link " href="#">Siguiente</a>
        </li>
    </ul>
</nav>
<div class="modal fade modal-delete-report" id="modal-delete-report" tabindex="-1" aria-labelledby="modal-delete-reportLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body">
        <img class="alert_icon" src="<?= Yii::getAlias('@web') ?>/assets/images/alert_icon.svg" alt="">
        <p class="">¿Estas seguro que deseas eliminar este reporte?</p>
        <input type="hidden" id="report_delete_id" name="report_delete_id">
        <div class="d-flex justify-content-end align-items-center">
            <a class="btn_cancel" data-dismiss="modal">Cancelar</a>
            <a class="btn_continue_delete_report" id="btn-confirm-delete-report" href="#">Continuar</a>
        </div>
      </div>
    </div>
  </div>
</div>