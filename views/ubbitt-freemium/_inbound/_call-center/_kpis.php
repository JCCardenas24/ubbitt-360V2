<div class="d-flex wid-100 justify-content-end">
    <div class="col-4 d-flex justify-content-between">
        <div class="form-group wid-100 d-flex m-0">
            <div id="freemium-kpis-date-range" class="range-pick">
                <i class="fa fa-calendar"></i>&nbsp;
                <span class="text-date"></span>&nbsp;&nbsp;<i class="fa fa-caret-down"></i>
            </div>
        </div>
    </div>
    <a class="pdf_button"><i class="icon-download_pdf c-gray"></i></a>
</div>
<br>
<div class="container_kpis_cards">
    <div class="fst_row row m-0">
        <div class="col-3">
            <div class="card">
                <div class="row m-0 he-100 info_t1">
                    <div class="col-6 p-0">
                        <div class="text-left he-100 wid-100">
                            <p class="m-0">Número de
                                llamadas
                                entrantes</p>
                        </div>
                    </div>
                    <div class="col-6 p-0 number_calls">
                        <p class="m-0" id="kpi-inbound-calls">0</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card green">
                <div class="row m-0 he-100 info_t1">
                    <div class="col-6 p-0">
                        <div class="text-left he-100 wid-100">
                            <p class="m-0">Número de
                                llamadas
                                contestadas</p>
                        </div>
                    </div>
                    <div class="col-6 p-0 number_calls">
                        <p class="m-0" id="kpi-answered-calls">0</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card gray">
                <div class="row m-0 he-100 info_t1">
                    <div class="col-6 p-0">
                        <div class="text-left he-100 wid-100">
                            <p class="m-0">Número de
                                llamadas
                                salientes</p>
                        </div>
                    </div>
                    <div class="col-6 p-0 number_calls">
                        <p class="m-0" id="kpi-outbound-calls">0</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card dark-orange">
                <div class="row m-0 he-100 info_t1">
                    <div class="col-6 p-0">
                        <div class="text-left he-100 wid-100">
                            <p class="m-0">Número de
                                llamadas
                                perdidas</p>
                        </div>
                    </div>
                    <div class="col-6 p-0 number_calls">
                        <p class="m-0" id="kpi-lost-calls">0</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="scd_row row m-0">
        <div class="col ">
            <div class="card info_t2">
                <p class="m-0 big_ttl"></p>
                <p class="m-0 sub_ttl">Atendidos antes de 25 <br> segundos</p>
                <span id="kpi-calls-answered-within-25-seconds">0</span>
            </div>
        </div>
        <div class="col">
            <div class="card info_t2">
                <p class="m-0 big_ttl">NSL</p>
                <p class="m-0 sub_ttl">(NSL/NCO)</p>
                <span id="kpi-nsl-percentage">0%</span>
            </div>
        </div>
        <div class="col">
            <div class="card info_t2">
                <p class="m-0 big_ttl">ABA</p>
                <p class="m-0 sub_ttl">Abandonados antes de 5 segundos</p>
                <span id="kpi-abandoned-before-5-seconds">0</span>
            </div>
        </div>
        <div class="col">
            <div class="card info_t2">
                <p class="m-0 big_ttl">%Abandono</p>
                <p class="m-0 sub_ttl">(Colgado)</p>
                <span id="kpi-abandonment">0%</span>
            </div>
        </div>
        <div class="col">
            <div class="card info_t2">
                <p class="m-0 big_ttl">ATH</p>
                <p class="m-0 sub_ttl">Tiempo promedio en llamada</p>
                <span id="kpi-ath">0 min</span>
            </div>
        </div>
    </div>
    <div class="thrt_row row m-0">
        <div class="d-flex wid-100">
            <div class="col-6 mb-0">
                <div class="card">
                    <p>Tiempo promedio <br>
                        en contestar la <br>
                        llamada</p>
                    <h5 id="kpi-average-time-in-answering-call">0 seg</h5>
                </div>
            </div>
            <div class="col-6 mb-0">
                <div class="card">
                    <p>Speaking time</p>
                    <h5 id="kpi-speaking-time">00:00 hrs</h5>
                </div>
            </div>
        </div>
    </div>
</div>