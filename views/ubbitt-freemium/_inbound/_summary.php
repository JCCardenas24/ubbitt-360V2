<div class="wid-100 freemium-inbound-resumen mt-40">
    <div class="d-flex justify-content-between">
        <h1>Dashboard de producción</h1>
        <div class="">
            <div class="d-flex mb-20">
                <div class="d-flex wid-100 justify-content-end">
                    <div class=" d-flex justify-content-between mr-5">
                        <div class="form-group wid-100 d-flex m-0">
                            <div id="freemium-summary-date-range" class="range-pick">
                                <i class="fa fa-calendar"></i>&nbsp;
                                <span class="text-date"></span>&nbsp;&nbsp;<i class="fa fa-caret-down"></i>
                            </div>
                        </div>
                    </div>
                    <a href="#" class="pdf_button mr-5"><i class="icon-download_pdf c-gray" aria-hidden="true"></i></a>
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
        <ct-visualization id="tree-container"></ct-visualization>
    </div>
    <div class="container_cards_resumen_info">
        <div class="row ml-0 mr-0">
            <div class="col-4">
                <div class="card">
                    <div class="d-flex he-100 justify-content-center align-items-center">
                        <div class="col-6 p-0 text-center">
                            <p class="m-0">NCO</p> <br>
                            <h5>Total de llamadas</h5>
                        </div>
                        <div class="col-6 p-0 text-center">
                            <small class="m-0" id="nco-total-calls-1">0</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card bg-c-orange">
                    <div class="d-flex he-100 justify-content-center align-items-center">
                        <div class="col-6 p-0 text-center">
                            <p class="m-0">NCO</p> <br>
                            <h5>Total de llamadas</h5>
                        </div>
                        <div class="col-6 p-0 text-center">
                            <small class="m-0" id="nco-total-calls-2">0</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="d-flex he-100 justify-content-center align-items-center">
                        <div class="col-6 p-0 text-center">
                            <p class="m-0">NCO</p> <br>
                            <h5>Total de llamadas</h5>
                        </div>
                        <div class="col-6 p-0 text-center">
                            <small class="m-0" id="nco-total-calls-3">0</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container_cards_ventas_info">
        <div class="row ml-0 mr-0">
            <div class="col-2">
                <div class="card">
                    <p class="m-0">Total <br>
                        de ventas</p>
                    <small id="total-sales">0</small>
                </div>
            </div>
            <div class="col-2">
                <div class="card">
                    <p class="m-0">Monto total <br>
                        vendido</p>
                    <small id="sales-total-amount">$0</small>
                </div>
            </div>
            <div class="col-2">
                <div class="card">
                    <p class="m-0">% conversión</p>
                    <small id="conversion-percentage">0%</small>
                </div>
            </div>
            <div class="col-2">
                <div class="card">
                    <p class="m-0">Total de <br>
                        emisiones</p>
                    <small id="emissions-total">0</small>
                </div>
            </div>
            <div class="col-2">
                <div class="card">
                    <p class="m-0">% de cobranza</p>
                    <small id="collection-percentage">0%</small>
                </div>
            </div>
            <div class="col-2">
                <div class="card">
                    <p class="m-0">Total de <br>
                        cobros</p>
                    <small id="total-collections">0</small>
                </div>
            </div>
        </div>
    </div>
    <div class="container_concentrado_polizas">
        <div class="row m-0">
            <div class="col-6 wid-100 pl-0">
                <div class="card fst_card">
                    <div class="col-12 p-0">
                        <div id="sales-concentrate-graph" style="height:350px;"></div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card wid-100 pr-0">
                    <small>Venta emitida total</small>
                    <p id="total-sale-issued">$0</p>
                </div>
                <div class="card wid-100">
                    <small>Venta pagada total</small>
                    <p id="total-sale-paid">$0</p>
                </div>
            </div>
        </div>
    </div>
    <div class="container_clasifiacion_llamadas">
        <div class="row m-0">
            <div class="col-6 pl-0">
                <div class="card fst_card mb-0">
                    <div class="col-12 p-0">
                        <div id="total-typification-graph" style="height:350px;"></div>
                    </div>
                </div>
            </div>
            <div class="col-6 pr-0">
                <div class="card scd_card mb-0">
                    <div class="wid-100">
                        <div class="big_ttl_">
                            <h1>Motivo de venta</h1>
                            <h1 id="sale-reason">0 / <span>0%</span></h1>
                        </div>
                        <p class="">Agenda llamada</p>
                        <div class="d-flex href_detalle">
                            <span class="ttl_detalle href_bd_freemium">Ver detalle</span><span class="ttl_number"
                                id="call-scheduled">0</span>
                        </div>
                        <div class="progress">
                            <div id="call-scheduled-percentage" class="progress-bar magenta" role="progressbar"
                                style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <p>Acepta venta</p>
                        <div class="d-flex href_detalle">
                            <span class="ttl_detalle href_bd_freemium">Ver detalle</span><span class="ttl_number"
                                id="sale-accepted">0</span>
                        </div>
                        <div class="progress">
                            <div id="sale-accepted-percentage" class="progress-bar magenta" role="progressbar"
                                style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <p>Agenda promesa de pago</p>
                        <div class="d-flex href_detalle">
                            <span class="ttl_detalle href_bd_freemium">Ver detalle</span><span class="ttl_number"
                                id="payment-promise-scheduled">0</span>
                        </div>
                        <div class="progress">
                            <div id="payment-promise-scheduled-percentage" class="progress-bar magenta"
                                role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0"
                                aria-valuemax="100"></div>
                        </div>
                        <p>Envía ficha de pago</p>
                        <div class="d-flex href_detalle">
                            <span class="ttl_detalle href_bd_freemium">Ver detalle</span><span class="ttl_number"
                                id="deposit-slip-sent">0</span>
                        </div>
                        <div class="progress">
                            <div id="deposit-slip-sent-percentage" class="progress-bar magenta" role="progressbar"
                                style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container_graficas_llamadas">
        <h1 class="ttl_llamadas">Llamadas ATC</h1>
        <div class="row m-0">

            <div class="col-3 pl-0">
                <div class="card atc_cards">
                    <h1>Asistencia Ubbitt</h1>
                    <p id="cust-serv-calls-ubbitt-assistance">0 / <span>0%</span></p>
                    <h4>Dudas de producto</h4>
                    <div class="d-flex">
                        <span class="ttl_detalle href_bd_freemium">Ver detalle</span><span class="ttl_number"
                            id="cust-serv-calls-product-questions">0</span>
                    </div>
                    <div class="progress">
                        <div id="cust-serv-calls-product-questions-percentage" class="progress-bar aqua"
                            role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0"
                            aria-valuemax="100"></div>
                    </div>
                    <h4>Asesorías de producto</h4>
                    <div class="d-flex">
                        <span class="ttl_detalle href_bd_freemium">Ver detalle</span><span class="ttl_number"
                            id="cust-serv-calls-product-advisory">0</span>
                    </div>
                    <div class="progress">
                        <div id="cust-serv-calls-product-advisory-percentage" class="progress-bar aqua"
                            role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0"
                            aria-valuemax="100"></div>
                    </div>
                    <h4>Enlace de producto</h4>
                    <div class="d-flex">
                        <span class="ttl_detalle href_bd_freemium">Ver detalle</span><span class="ttl_number"
                            id="cust-serv-calls-product-linkage">0</span>
                    </div>
                    <div class="progress">
                        <div id="cust-serv-calls-product-linkage-percentage" class="progress-bar aqua"
                            role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0"
                            aria-valuemax="100"></div>
                    </div>
                    <h4>Enlace de coberturas</h4>
                    <div class="d-flex">
                        <span class="ttl_detalle href_bd_freemium">Ver detalle</span><span class="ttl_number"
                            id="cust-serv-calls-coverage-linkage">0</span>
                    </div>
                    <div class="progress">
                        <div id="cust-serv-calls-coverage-linkage-percentage" class="progress-bar aqua"
                            role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0"
                            aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card atc_cards">
                    <h1>Otros productos</h1>
                    <p id="cust-serv-calls-other-products">0 / <span>0%</span></p>
                    <h4>Gastos médicos</h4>
                    <div class="d-flex">
                        <span class="ttl_detalle href_bd_freemium">Ver detalle</span><span class="ttl_number"
                            id="cust-serv-calls-other-products-medical-expenses">0</span>
                    </div>
                    <div class="progress">
                        <div id="cust-serv-calls-other-products-medical-expenses-percentage" class="progress-bar navy"
                            role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0"
                            aria-valuemax="100"></div>
                    </div>
                    <h4>Vida</h4>
                    <div class="d-flex">
                        <span class="ttl_detalle href_bd_freemium">Ver detalle</span><span class="ttl_number"
                            id="cust-serv-calls-other-products-life">0</span>
                    </div>
                    <div class="progress">
                        <div id="cust-serv-calls-other-products-life-percentage" class="progress-bar navy"
                            role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0"
                            aria-valuemax="100"></div>
                    </div>
                    <h4>Legalizados</h4>
                    <div class="d-flex">
                        <span class="ttl_detalle href_bd_freemium">Ver detalle</span><span class="ttl_number"
                            id="cust-serv-calls-other-products-legalized">0</span>
                    </div>
                    <div class="progress">
                        <div id="cust-serv-calls-other-products-legalized-percentage" class="progress-bar navy"
                            role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0"
                            aria-valuemax="100"></div>
                    </div>
                    <h4>Plataformas</h4>
                    <div class="d-flex">
                        <span class="ttl_detalle href_bd_freemium">Ver detalle</span><span class="ttl_number"
                            id="cust-serv-calls-other-products-platforms">0</span>
                    </div>
                    <div class="progress">
                        <div id="cust-serv-calls-other-products-platforms-percentage" class="progress-bar navy"
                            role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0"
                            aria-valuemax="100"></div>
                    </div>
                    <h4>Residénciales</h4>
                    <div class="d-flex">
                        <span class="ttl_detalle href_bd_freemium">Ver detalle</span><span class="ttl_number"
                            id="cust-serv-calls-other-products-residential">0</span>
                    </div>
                    <div class="progress">
                        <div id="cust-serv-calls-other-products-residential-percentage" class="progress-bar navy"
                            role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0"
                            aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card atc_cards">
                    <h1>Atención clientes</h1>
                    <p id="cust-serv-cust-serv">0 / <span>0%</span></p>
                    <h4>Reportar atención de asesor</h4>
                    <div class="d-flex">
                        <span class="ttl_detalle href_bd_freemium">Ver detalle</span><span class="ttl_number"
                            id="cust-serv-cust-serv-report-advisor-care">0</span>
                    </div>
                    <div class="progress">
                        <div id="cust-serv-cust-serv-report-advisor-care-percentage" class="progress-bar orange"
                            role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0"
                            aria-valuemax="100"></div>
                    </div>
                    <h4>Revisión renovación póliza</h4>
                    <div class="d-flex">
                        <span class="ttl_detalle href_bd_freemium">Ver detalle</span><span class="ttl_number"
                            id="cust-serv-cust-serv-policy-renewal-review">0</span>
                    </div>
                    <div class="progress">
                        <div id="cust-serv-cust-serv-policy-renewal-review-percentage" class="progress-bar orange"
                            role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0"
                            aria-valuemax="100"></div>
                    </div>
                    <h4>Cancelación de producto</h4>
                    <div class="d-flex">
                        <span class="ttl_detalle href_bd_freemium">Ver detalle</span><span class="ttl_number"
                            id="cust-serv-cust-serv-product-cancellation">0</span>
                    </div>
                    <div class="progress">
                        <div id="cust-serv-cust-serv-product-cancellation-percentage" class="progress-bar orange"
                            role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0"
                            aria-valuemax="100"></div>
                    </div>
                    <h4>Checar fechas de vigencia</h4>
                    <div class="d-flex">
                        <span class="ttl_detalle href_bd_freemium">Ver detalle</span><span class="ttl_number"
                            id="cust-serv-cust-serv-check-expiration-dates">0</span>
                    </div>
                    <div class="progress">
                        <div id="cust-serv-cust-serv-check-expiration-dates-percentage" class="progress-bar orange"
                            role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0"
                            aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
            <div class="col-3 pr-0">
                <div class="card atc_cards">
                    <h1>Dudas de cobranza</h1>
                    <p id="cust-serv-collection-questions">0 / <span>0%</span></p>
                    <h4>Seguimiento pago</h4>
                    <div class="d-flex">
                        <span class="ttl_detalle href_bd_freemium">Ver detalle</span><span class="ttl_number"
                            id="cust-serv-collection-questions-payment-track">0</span>
                    </div>
                    <div class="progress">
                        <div id="cust-serv-collection-questions-payment-track-percentage" class="progress-bar yellow"
                            role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0"
                            aria-valuemax="100"></div>
                    </div>
                    <h4>Reembolsos</h4>
                    <div class="d-flex">
                        <span class="ttl_detalle href_bd_freemium">Ver detalle</span><span class="ttl_number"
                            id="cust-serv-collection-questions-refund">0</span>
                    </div>
                    <div class="progress">
                        <div id="cust-serv-collection-questions-refund-percentage" class="progress-bar yellow"
                            role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0"
                            aria-valuemax="100"></div>
                    </div>
                    <h4>Aclaración pagos</h4>
                    <div class="d-flex">
                        <span class="ttl_detalle href_bd_freemium">Ver detalle</span><span class="ttl_number"
                            id="cust-serv-collection-questions-payment-clarification">0</span>
                    </div>
                    <div class="progress">
                        <div id="cust-serv-collection-questions-payment-clarification-percentage"
                            class="progress-bar yellow" role="progressbar" style="width: 0%" aria-valuenow="0"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4>Realizar pago</h4>
                    <div class="d-flex">
                        <span class="ttl_detalle href_bd_freemium">Ver detalle</span><span class="ttl_number"
                            id="cust-serv-collection-questions-make-payment">0</span>
                    </div>
                    <div class="progress">
                        <div id="cust-serv-collection-questions-make-payment-percentage" class="progress-bar yellow"
                            role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0"
                            aria-valuemax="100"></div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>