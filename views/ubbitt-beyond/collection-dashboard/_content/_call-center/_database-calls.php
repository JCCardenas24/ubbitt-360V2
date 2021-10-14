<div class="d-flex justify-content-end mb-20">
    <div class="input-group input_group_search mr-5">
        <!-- <select class="form-control form-control-sm col-3 mr-5">
            <option selected="">Por tipificación</option>
        </select> -->
        <input id="search-term" type="text" class="form-control" placeholder="Buscar">
        <div class="input-group-append">
            <button class="btn btn-secondary" type="button" onclick="onFilterCallsDatabase()">
                <i class="fa fa-search"></i>
            </button>
        </div>
    </div>
    <div id="beyond-calls-database-date-range" class="range-pick range_dates_width mr-5">
        <i class="fa fa-calendar"></i>&nbsp;
        <span class="text-date"></span>&nbsp;&nbsp;<i class="fa fa-caret-down"></i>
    </div>
    <!-- <a href="#" class="pdf_button mr-5"><i class="icon-download_xls"></i></a> -->
    <a href="#" class="pdf_button" onclick="onDownloadCalls(event)"><i class="fa fa-download"
            aria-hidden="true"></i></a>
</div>
<br>
<?= $this->render('_database-calls/_table') ?>