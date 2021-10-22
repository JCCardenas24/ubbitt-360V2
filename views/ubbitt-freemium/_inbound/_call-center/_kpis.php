<div class="d-flex wid-100 justify-content-end">
    <div class="col-4 d-flex justify-content-between">
        <div class="form-group wid-100 d-flex m-0">
            <div id="freemium-kpis-date-range" class="range-pick">
                <i class="fa fa-calendar"></i>&nbsp;
                <span class="text-date"></span>&nbsp;&nbsp;<i class="fa fa-caret-down"></i>
            </div>
        </div>
    </div>
    <!-- <a class="pdf_button"><i class="icon-download_pdf c-gray"></i></a> -->
</div>
<br>
<div class="container_kpis_cards">
    <div class="fst_row row m-0">
        <div class="col-3">
            <div class="card">
                <a type="button" class="tooltip_btn" data-toggle="tooltip" data-placement="left" data-html="true"
                    title="Número de llamadas ofrecidas/Number of calls offered. Es el número de llamadas entrantes al DID asignado para campaña.">
                    <i class="ri-information-fill"></i>
                </a>
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
                <a type="button" class="tooltip_btn" data-toggle="tooltip" data-placement="left" data-html="true"
                    title="Número de llamadas manejadas/Number of calls handled. Es el número de llamadas entrantes al DID asignado contestadas.">
                    <i class="ri-information-fill"></i>
                </a>
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
                <a type="button" class="tooltip_btn" data-toggle="tooltip" data-placement="left" data-html="true"
                    title="Es el número de llamadas salientes del DID asignado.">
                    <i class="ri-information-fill"></i>
                </a>
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
                <a type="button" class="tooltip_btn" data-toggle="tooltip" data-placement="left" data-html="true"
                    title="Es el número de llamadas entrantes al DID asignado que no fueron contestadas.">
                    <i class="ri-information-fill"></i>
                </a>
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
                <a type="button" class="tooltip_btn" data-toggle="tooltip" data-placement="left" data-html="true"
                    title="Nivel de servicio: Es el número de llamadas contestadas antes de 25 segundos.">
                    <i class="ri-information-fill"></i>
                </a>
                <p class="m-0 big_ttl">NSL</p>
                <p class="m-0 sub_ttl">Atendidos antes de 25 <br> segundos</p>
                <span id="kpi-calls-answered-within-25-seconds">0</span>
            </div>
        </div>
        <div class="col">
            <div class="card info_t2">
                <a type="button" class="tooltip_btn" data-toggle="tooltip" data-placement="left" data-html="true"
                    title="Porcentaje de Nivel de servicio: Es el número de llamadas contestadas antes de 25 segundos / el número de llamadas entrantes.">
                    <i class="ri-information-fill"></i>
                </a>
                <p class="m-0 big_ttl">NSL</p>
                <p class="m-0 sub_ttl">(NSL/NCO)</p>
                <span id="kpi-nsl-percentage">0%</span>
            </div>
        </div>
        <div class="col">
            <div class="card info_t2">
                <a type="button" class="tooltip_btn" data-toggle="tooltip" data-placement="left" data-html="true"
                    title="Abandono, total de llamadas que no se contestaron.">
                    <i class="ri-information-fill"></i>
                </a>
                <p class="m-0 big_ttl">ABA</p>
                <p class="m-0 sub_ttl">Abandonados antes de 5 segundos</p>
                <span id="kpi-abandoned-before-5-seconds">0</span>
            </div>
        </div>
        <div class="col">
            <div class="card info_t2">
                <a type="button" class="tooltip_btn" data-toggle="tooltip" data-placement="left" data-html="true"
                    title="Abandono, total de llamadas que no se contestaron / el número de llamadas entrantes.">
                    <i class="ri-information-fill"></i>
                </a>
                <p class="m-0 big_ttl">%Abandono</p>
                <p class="m-0 sub_ttl">(Colgado)</p>
                <span id="kpi-abandonment">0%</span>
            </div>
        </div>
        <div class="col">
            <div class="card info_t2">
                <a type="button" class="tooltip_btn" data-toggle="tooltip" data-placement="left" data-html="true"
                    title="Average handle time (AHT) Tiempo promedio en llamada.">
                    <i class="ri-information-fill"></i>
                </a>
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
                    <a type="button" class="tooltip_btn" data-toggle="tooltip" data-placement="left" data-html="true"
                        title="Average Speed of Answer o tiempo promedio de espera.">
                        <i class="ri-information-fill"></i>
                    </a>
                    <p><b>ASA</b>Tiempo promedio
                        en contestar la
                        llamada</p>
                    <h5 id="kpi-average-time-in-answering-call">0 seg</h5>
                </div>
            </div>
            <div class="col-6 mb-0">
                <div class="card">
                    <a type="button" class="tooltip_btn" data-toggle="tooltip" data-placement="left" data-html="true"
                        title="Tiempo promedio productivo.">
                        <i class="ri-information-fill"></i>
                    </a>
                    <p>Speaking time</p>
                    <h5 id="kpi-speaking-time">00:00 hr</h5>
                </div>
            </div>
        </div>
    </div>
</div>