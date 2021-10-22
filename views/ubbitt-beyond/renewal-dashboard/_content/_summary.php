<div class="wid-100 freemium-inbound-resumen resumen-beyond-cobranza mt-40">
    <div class="d-flex justify-content-between">
        <h1>Dashboard de producción</h1>
        <div class="">
            <div class="d-flex mb-20">
                <div class="d-flex wid-100 justify-content-end">
                    <div class=" d-flex justify-content-between mr-5">
                        <div class="form-group wid-100 d-flex m-0">
                            <div id="beyond-renewal-summary-date-range" class="range-pick">
                                <i class="fa fa-calendar"></i>&nbsp;
                                <span class="text-date"></span>&nbsp;&nbsp;<i class="fa fa-caret-down"></i>
                            </div>
                        </div>
                    </div>
                    <!-- <a href="#" class="pdf_button mr-5"><i class="icon-download_pdf c-gray" aria-hidden="true"></i></a> -->
                </div>
            </div>
        </div>
    </div>
    <div class="container_chart-1">
        <h1>Transacciones</h1>
        <div class=" col-12">
            <div id="stacked-line" style="height:400px;"></div>
        </div>
    </div>

    <div class="container_chart-2">
        <div class="row m-0 wid-100">
            <div class="col-3">
                <div class="card card-gestion">
                    <div class="header">
                        <p>Base entregada (Registros)</p>
                        <h5 id="delivered-base">0</h5>
                    </div>
                    <div class="info_gestion">
                        <p>Aceptados</p>
                        <h5 id="delivered-base-accepted">0
                            <!-- / <span>0%</span> -->
                        </h5>
                    </div>
                    <div class="info_gestion">
                        <p>Rechazados</p>
                        <h5 id="delivered-base-rejected">0
                            <!-- / <span>0%</span> -->
                        </h5>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card card-gestion">
                    <div class="header">
                        <p>Primera gestión</p>
                        <h5 id="first-management">0
                            <!-- / <span>0%</span>  -->
                        </h5>
                    </div>
                    <div class="info_gestion">
                        <p>Registros efectivos</p>
                        <h5 id="first-management-effective-registries">0
                            <!-- / <span>0%</span>  -->
                            <span class="mini_price">($0)</span>
                        </h5>
                    </div>
                    <div class="info_gestion">
                        <p>Registros en seguimiento</p>
                        <h5 id="first-management-on-track-registries">0
                            <!-- / <span>0%</span> -->
                        </h5>
                    </div>
                    <div class="info_gestion">
                        <p>Registros fuera de gestión</p>
                        <h5 id="first-management-out-of-management-registries">0
                            <!-- / <span>0%</span> -->
                        </h5>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card card-gestion">
                    <div class="header">
                        <p>Segunda gestión</p>
                        <h5 id="second-management">0
                            <!-- / <span>0%</span> -->
                        </h5>
                    </div>
                    <div class="info_gestion">
                        <p>Registros efectivos</p>
                        <h5 id="second-management-effective-registries">0
                            <!-- / <span>0%</span>  -->
                            <span class="mini_price">($0)</span>
                        </h5>
                    </div>
                    <div class="info_gestion">
                        <p>Registros en seguimiento</p>
                        <h5 id="second-management-on-track-registries">0
                            <!-- / <span>0%</span> -->
                        </h5>
                    </div>
                    <div class="info_gestion">
                        <p>Registros fuera de gestión</p>
                        <h5 id="second-management-out-of-management-registries">0
                            <!-- / <span>0%</span> -->
                        </h5>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card card-gestion">
                    <div class="header">
                        <p>Tercera gestión</p>
                        <h5 id="third-management">0
                            <!-- / <span>0%</span> -->
                        </h5>
                    </div>
                    <div class="info_gestion">
                        <p>Registros efectivos</p>
                        <h5 id="third-management-effective-registries">0
                            <!-- / <span>0%</span>  -->
                            <span class="mini_price">($0)</span>
                        </h5>
                    </div>
                    <div class="info_gestion">
                        <p>Registros en seguimiento</p>
                        <h5 id="third-management-on-track-registries">0
                            <!-- / <span>0%</span> -->
                        </h5>
                    </div>
                    <div class="info_gestion">
                        <p>Registros fuera de gestión</p>
                        <h5 id="third-management-out-of-management-registries">0
                            <!-- / <span>0%</span> -->
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container_cards_ventas_info">
        <div class="row ml-0 mr-0">
            <div class="col-2 offset-1 pl-0">
                <div class="card">
                    <a type="button" class="tooltip_btn" data-toggle="tooltip" data-placement="left" data-html="true"
                        title="Registros cobrados de manera exitosa.">
                        <i class="ri-information-fill"></i>
                    </a>
                    <p class="m-0">Total <br>cobrados</p><small id="total-collected">0</small>
                </div>
            </div>
            <div class="col-2">
                <div class="card">
                    <a type="button" class="tooltip_btn" data-toggle="tooltip" data-placement="left" data-html="true"
                        title="Llamadas conectadas / Registros pagados">
                        <i class="ri-information-fill"></i>
                    </a>
                    <p class="m-0">%<br>conversión</p><small id="conversion-percentage">0%</small>
                </div>
            </div>
            <div class="col-2">
                <div class="card">
                    <a type="button" class="tooltip_btn" data-toggle="tooltip" data-placement="left" data-html="true"
                        title="Monto neto cobrado total de los registros exitosos.">
                        <i class="ri-information-fill"></i>
                    </a>
                    <p class="m-0">Monto <br>cobrado</p><small id="collected-amount">$0</small>
                </div>
            </div>
            <div class="col-2">
                <div class="card">
                    <a type="button" class="tooltip_btn" data-toggle="tooltip" data-placement="left" data-html="true"
                        title="Registros con tipificación en seguimiento ">
                        <i class="ri-information-fill"></i>
                    </a>
                    <p class="m-0">Registros en <br>seguimiento</p><small id="on-track-registries">0</small>
                </div>
            </div>
            <div class="col-2">
                <div class="card">
                    <a type="button" class="tooltip_btn" data-toggle="tooltip" data-placement="left" data-html="true"
                        title="Es el monto del recibo de pago neto por cobrar.">
                        <i class="ri-information-fill"></i>
                    </a>
                    <p class="m-0">Monto <br>pendiente</p><small id="pending-amount">$0</small>
                </div>
            </div>
        </div>
    </div>
    <div class="container_graficas_llamadas">
        <div class="d-flex justify-content-between align-items-center mb-30">
            <h4 class="mb-0">Por gestión</h4>
            <select class="form-control form-control-sm" id="management-selector">
                <option value="all_man_det_" selected>Todas las gestiones</option>
                <option value="fir_man_det_">Primera gestión</option>
                <option value="sec_man_det_">Segunda gestión</option>
                <option value="thir_man_det_">Tercera gestión</option>
                <option value="four_man_det_">Cuarta gestión</option>
            </select>
        </div>
        <div class="row m-0">
            <div class="col-4 pl-0">
                <div class="card atc_cards">
                    <h1>Registros efectivos</h1>
                    <p id="by-management-effective-registries">0
                        <!-- / <span>0%</span> -->
                    </p>
                    <div class="d-flex mb-5">
                        <div class="d-flex justify-content-center align-items-center">
                            <h4 class="mb-0">Agenda promesa de pago</h4>
                            <!-- <span class="ml-5 mr-5"><b>|</b></span>
                            <span
                                class="ttl_detalle href_bd_cobra">Ver detalle</span> -->
                        </div><span class="ttl_number"
                            id="by-management-effective-registries-payment-promise-scheduled">0</span>
                    </div>
                    <div class="progress">
                        <div id="by-management-effective-registries-payment-promise-scheduled-percentage"
                            class="progress-bar aqua" role="progressbar" style="width: 0%" aria-valuenow="0"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="d-flex mb-5">
                        <div class="d-flex justify-content-center align-items-center">
                            <h4 class="mb-0">Pago en línea</h4>
                            <!-- <span class="ml-5 mr-5"><b>|</b></span>
                            <span
                                class="ttl_detalle href_bd_cobra">Ver detalle</span> -->
                        </div><span class="ttl_number" id="by-management-effective-registries-online-payment">0</span>
                    </div>
                    <div class="progress">
                        <div id="by-management-effective-registries-online-payment-percentage" class="progress-bar aqua"
                            role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0"
                            aria-valuemax="100"></div>
                    </div>
                    <div class="d-flex mb-5">
                        <div class="d-flex justify-content-center align-items-center">
                            <h4 class="mb-0">Acepta Póliza nueva</h4>
                            <!-- <span class="ml-5 mr-5"><b>|</b></span>
                            <span
                                class="ttl_detalle href_bd_cobra">Ver detalle</span> -->
                        </div><span class="ttl_number"
                            id="by-management-effective-registries-new-policy-accepted">0</span>
                    </div>
                    <div class="progress">
                        <div id="by-management-effective-registries-new-policy-accepted-percentage"
                            class="progress-bar aqua" role="progressbar" style="width: 0%" aria-valuenow="0"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="d-flex mb-5">
                        <div class="d-flex justify-content-center align-items-center">
                            <h4 class="mb-0">Acepta Pago con 5% por domiciliación </h4>
                            <!-- <span
                                class="ml-5 mr-5"><b>|</b></span>
                            <span class="ttl_detalle href_bd_cobra">Ver
                                detalle</span> -->
                        </div><span class="ttl_number"
                            id="by-management-effective-registries-accepted-direct-debit-payment">0</span>
                    </div>
                    <div class="progress">
                        <div id="by-management-effective-registries-accepted-direct-debit-payment-percentage"
                            class="progress-bar aqua" role="progressbar" style="width: 0%" aria-valuenow="0"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="d-flex mb-5">
                        <div class="d-flex justify-content-center align-items-center">
                            <h4 class="mb-0">Se envía ficha de deposito </h4>
                            <!-- <span class="ml-5 mr-5"><b>|</b></span>
                            <span class="ttl_detalle href_bd_cobra">Ver
                                detalle</span> -->
                        </div><span class="ttl_number"
                            id="by-management-effective-registries-deposit-slip-sent">0</span>
                    </div>
                    <div class="progress">
                        <div id="by-management-effective-registries-deposit-slip-sent-percentage"
                            class="progress-bar aqua" role="progressbar" style="width: 0%" aria-valuenow="0"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card atc_cards">
                    <h1>Registros en seguimiento</h1>
                    <p id="by-management-on-track-registries">0
                        <!-- / <span>0%</span> -->
                    </p>
                    <div class="d-flex mb-5">
                        <div class="d-flex justify-content-center align-items-center">
                            <h4 class="mb-0">Agenda llamada</h4>
                            <!-- <span class="ml-5 mr-5"><b>|</b></span>
                            <span
                                class="ttl_detalle href_bd_cobra">Ver detalle</span> -->
                        </div><span class="ttl_number" id="by-management-on-track-registries-call-scheduled">0</span>
                    </div>
                    <div class="progress">
                        <div id="by-management-on-track-registries-call-scheduled-percentage" class="progress-bar navy"
                            role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0"
                            aria-valuemax="100"></div>
                    </div>
                    <div class="d-flex mb-5">
                        <div class="d-flex justify-content-center align-items-center">
                            <h4 class="mb-0">No contesta</h4>
                            <!-- <span class="ml-5 mr-5"><b>|</b></span>
                            <span
                                class="ttl_detalle href_bd_cobra">Ver detalle</span> -->
                        </div><span class="ttl_number" id="by-management-on-track-registries-does-not_answer">0</span>
                    </div>
                    <div class="progress">
                        <div id="by-management-on-track-registries-does-not-answer-percentage" class="progress-bar navy"
                            role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0"
                            aria-valuemax="100"></div>
                    </div>
                    <div class="d-flex mb-5">
                        <div class="d-flex justify-content-center align-items-center">
                            <h4 class="mb-0">Buzón</h4>
                            <!-- <span class="ml-5 mr-5"><b>|</b></span>
                            <span
                                class="ttl_detalle href_bd_cobra">Ver detalle</span> -->
                        </div><span class="ttl_number" id="by-management-on-track-registries-voice-mail">0</span>
                    </div>
                    <div class="progress">
                        <div id="by-management-on-track-registries-voice-mail-percentage" class="progress-bar navy"
                            role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0"
                            aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
            <div class="col-4 pr-0">
                <div class="card atc_cards">
                    <h1>Registros fuera de gestión</h1>
                    <p id="by-management-out-of-management-registries">0
                        <!-- / <span>0%</span> -->
                    </p>
                    <div class="d-flex mb-5">
                        <div class="d-flex justify-content-center align-items-center">
                            <h4 class="mb-0">Número equivocado</h4>
                            <!-- <span class="ml-5 mr-5"><b>|</b></span>
                            <span
                                class="ttl_detalle href_bd_cobra">Ver detalle</span> -->
                        </div><span class="ttl_number"
                            id="by-management-out-of-management-registries-wrong-number">0</span>
                    </div>
                    <div class="progress">
                        <div id="by-management-out-of-management-registries-wrong-number-percentage"
                            class="progress-bar magenta" role="progressbar" style="width: 0%" aria-valuenow="0"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="d-flex mb-5">
                        <div class="d-flex justify-content-center align-items-center">
                            <h4 class="mb-0">Póliza cancelada</h4>
                            <!-- <span class="ml-5 mr-5"><b>|</b></span>
                            <span
                                class="ttl_detalle href_bd_cobra">Ver detalle</span> -->
                        </div><span class="ttl_number"
                            id="by-management-out-of-management-registries-policy-cancelled">0</span>
                    </div>
                    <div class="progress">
                        <div id="by-management-out-of-management-registries-policy-cancelled-percentage"
                            class="progress-bar magenta" role="progressbar" style="width: 0%" aria-valuenow="0"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <!-- <div class="d-flex mb-5">
                        <div class="d-flex justify-content-center align-items-center">
                            <h4 class="mb-0">No contesta</h4>
                            <span class="ml-5 mr-5"><b>|</b></span>
                            <span
                                class="ttl_detalle href_bd_cobra">Ver
                                detalle</span>
                        </div><span class="ttl_number"
                            id="by-management-out-of-management-registries-does-not-answer">0</span>
                    </div> -->
                    <div class="progress">
                        <div id="by-management-out-of-management-registries-does-not-answer-percentage"
                            class="progress-bar magenta" role="progressbar" style="width: 0%" aria-valuenow="0"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="d-flex mb-5">
                        <div class="d-flex justify-content-center align-items-center">
                            <h4 class="mb-0">Queja</h4>
                            <!-- <span class="ml-5 mr-5"><b>|</b></span>
                            <span
                                class="ttl_detalle href_bd_cobra">Ver
                                detalle</span> -->
                        </div><span class="ttl_number"
                            id="by-management-out-of-management-registries-complaint">0</span>
                    </div>
                    <div class="progress">
                        <div id="by-management-out-of-management-registries-complaint-percentage"
                            class="progress-bar magenta" role="progressbar" style="width: 0%" aria-valuenow="0"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="d-flex mb-5">
                        <div class="d-flex justify-content-center align-items-center">
                            <h4 class="mb-0">No gestionable en portal (ZA)</h4>
                            <!-- <span class="ml-5 mr-5"><b>|</b></span>
                            <span class="ttl_detalle href_bd_cobra">Ver
                                detalle</span> -->
                        </div><span class="ttl_number"
                            id="by-management-out-of-management-registries-not-manageable">0</span>
                    </div>
                    <div class="progress">
                        <div id="by-management-out-of-management-registries-not-manageable-percentage"
                            class="progress-bar magenta" role="progressbar" style="width: 0%" aria-valuenow="0"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="d-flex mb-5">
                        <div class="d-flex justify-content-center align-items-center">
                            <h4 class="mb-0">Registro perdido</h4>
                            <!-- <span class="ml-5 mr-5"><b>|</b></span>
                            <span
                                class="ttl_detalle href_bd_cobra">Ver detalle</span> -->
                        </div><span class="ttl_number"
                            id="by-management-out-of-management-registries-lost-registry">0</span>
                    </div>
                    <div class="progress">
                        <div id="by-management-out-of-management-registries-lost-registry-percentage"
                            class="progress-bar magenta" role="progressbar" style="width: 0%" aria-valuenow="0"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container_concentrado_polizas">
        <div class="row m-0">
            <div class="col-6 wid-100 pl-0">
                <div class="card fst_card">
                    <div class="col-12 p-0">
                        <div id="concentrate-on-track-graph" style="height:350px;"></div>
                    </div>
                </div>
            </div>
            <div class="col-6 pr-0">
                <div class="card wid-100 "><small>Venta pendiente total</small>
                    <p id="total-pending-sale-amount">$0</p>
                </div>
                <div class="card wid-100"><small>Venta renovada cobrada total</small>
                    <p id="total-renewed-sale-amount">$0</p>
                </div>
            </div>
        </div>
    </div>
</div>