<div class="d-flex justify-content-end mb-20">
    <div class="input-group input_group_search mr-5">
        <input id="search-term" type="text" class="form-control" placeholder="Buscar">
        <div class="input-group-append">
            <button class="btn btn-secondary" type="button" onclick="onFilterSalesDatabase()">
                <i class="fa fa-search"></i>
            </button>
        </div>
    </div>
    <div id="freemium-sales-database-date-range" class="range-pick range_dates_width mr-5">
        <i class="fa fa-calendar"></i>&nbsp;
        <span class="text-date"></span>&nbsp;&nbsp;<i class="fa fa-caret-down"></i>
    </div>
    <!-- <a href="./assets/reportes/prueba.xlsx" class="pdf_button mr-5" download><i class="icon-download_xls c-gray"
            aria-hidden="true"></i></a> -->
    <a href="./assets/reportes/prueba.xlsx" class="pdf_button" download><i class="fa fa-download"
            aria-hidden="true"></i></a>
</div>
<br>
<?= $this->render('_database-sales/_table') ?>