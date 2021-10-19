<div class="d-flex justify-content-end mb-20">
    <div class="input-group input_group_search mr-5">
        <input id="search-term-sales" type="text" class="form-control" placeholder="Buscar">
        <div class="input-group-append">
            <button class="btn btn-secondary" type="button" onclick="onFilterSalesDatabase()">
                <i class="fa fa-search"></i>
            </button>
        </div>
    </div>
    <div id="premium-sales-database-date-range" class="range-pick range_dates_width mr-5">
        <i class="fa fa-calendar"></i>&nbsp;
        <span class="text-date"></span>&nbsp;&nbsp;<i class="fa fa-caret-down"></i>
    </div>
    <!-- <a href="#" class="pdf_button mr-5"><i class="icon-download_xls"></i></a> -->
    <a href="#" class="pdf_button" onclick="onDownloadPolicies(event)"><i class="fa fa-download"
            aria-hidden="true"></i></a>
</div>
<br>
<div class="table-responsive wrapper_table_fixed_last_column">
    <table class="table table-hover table_fixed_last_column" id="premium-sales-table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Teléfono</th>
                <th scope="col">Correo electrónico</th>
                <th scope="col">Producto</th>
                <th scope="col">Estatus de cobro</th>
                <th scope="col">No. de Póliza</th>
                <th scope="col">Prima total</th>
                <th scope="col">Montal Pagado</th>
                <th scope="col">Asesor Asignado</th>
                <th scope="col">Fecha de venta</th>
                <th scope="col">Fecha de cobro</th>
                <th scope="col">Fecha de actividad</th>
                <th scope="col">Ticket</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-end" id="premium-sales-paginator">
        <li class="page-item disabled">
            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Anterior</a>
        </li>
        <li class="page-item"><a class="page-link" href="#">1</a></li>
        <li class="page-item disabled">
            <a class="page-link " href="#">Siguiente</a>
        </li>
    </ul>
</nav>