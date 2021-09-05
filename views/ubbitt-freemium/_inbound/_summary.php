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

                        <div id="basic-doughnut" style="height:350px;"></div>


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
                        <div id="basic-doughnut2" style="height:350px;"></div>
                    </div>
                </div>
            </div>
            <div class="col-6 pr-0">
                <div class="card scd_card mb-0">
                    <div class="wid-100">
                        <div class="big_ttl_">
                            <h1>Motivo de venta</h1>
                            <h1>24 / <span>18%</span></h1>
                        </div>
                        <p class="">Agenda llamada</p>
                        <div class="d-flex href_detalle">
                            <span class="ttl_detalle href_bd_freemium">Ver detalle</span><span
                                class="ttl_number">10</span>
                        </div>
                        <div class="progress">
                            <div class="progress-bar magenta" role="progressbar" style="width: 25%" aria-valuenow="25"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <p>Acepta venta</p>
                        <div class="d-flex href_detalle">
                            <span class="ttl_detalle href_bd_freemium">Ver detalle</span><span
                                class="ttl_number">10</span>
                        </div>
                        <div class="progress">
                            <div class="progress-bar magenta" role="progressbar" style="width: 25%" aria-valuenow="25"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <p>Agenda promesa de pago</p>
                        <div class="d-flex href_detalle">
                            <span class="ttl_detalle href_bd_freemium">Ver detalle</span><span
                                class="ttl_number">10</span>
                        </div>
                        <div class="progress">
                            <div class="progress-bar magenta" role="progressbar" style="width: 50%" aria-valuenow="50"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <p>Agenda llamada</p>
                        <div class="d-flex href_detalle">
                            <span class="ttl_detalle href_bd_freemium">Ver detalle</span><span
                                class="ttl_number">10</span>
                        </div>
                        <div class="progress">
                            <div class="progress-bar magenta" role="progressbar" style="width: 75%" aria-valuenow="75"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <p>Envía ficha de pago</p>
                        <div class="d-flex href_detalle">
                            <span class="ttl_detalle href_bd_freemium">Ver detalle</span><span
                                class="ttl_number">10</span>
                        </div>
                        <div class="progress">
                            <div class="progress-bar magenta" role="progressbar" style="width: 100%" aria-valuenow="100"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <button id="btn_prueba" class="d-none">test</button> -->
    <div class="container_graficas_llamadas">
        <h1 class="ttl_llamadas">Llamadas ATC</h1>
        <div class="row m-0">

            <div class="col-3 pl-0">
                <div class="card atc_cards">
                    <h1>Asistencia Ubbitt</h1>
                    <p>22 / <span>25%</span></p>
                    <h4>Dudas de producto</h4>
                    <div class="d-flex">
                        <span class="ttl_detalle href_bd_freemium">Ver detalle</span><span class="ttl_number">10</span>
                    </div>
                    <div class="progress">
                        <div class="progress-bar aqua" role="progressbar" style="width: 25%" aria-valuenow="25"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4>Asesorías de producto</h4>
                    <div class="d-flex">
                        <span class="ttl_detalle href_bd_freemium">Ver detalle</span><span class="ttl_number">10</span>
                    </div>
                    <div class="progress">
                        <div class="progress-bar aqua" role="progressbar" style="width: 25%" aria-valuenow="25"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4>Enlace de producto</h4>
                    <div class="d-flex">
                        <span class="ttl_detalle href_bd_freemium">Ver detalle</span><span class="ttl_number">10</span>
                    </div>
                    <div class="progress">
                        <div class="progress-bar aqua" role="progressbar" style="width: 25%" aria-valuenow="25"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4>Enlace de coberturas</h4>
                    <div class="d-flex">
                        <span class="ttl_detalle href_bd_freemium">Ver detalle</span><span class="ttl_number">10</span>
                    </div>
                    <div class="progress">
                        <div class="progress-bar aqua" role="progressbar" style="width: 25%" aria-valuenow="25"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card atc_cards">
                    <h1>Otros productos</h1>
                    <p>12 / <span>10%</span></p>
                    <h4>Gastos médicos</h4>
                    <div class="d-flex">
                        <span class="ttl_detalle href_bd_freemium">Ver detalle</span><span class="ttl_number">10</span>
                    </div>
                    <div class="progress">
                        <div class="progress-bar navy" role="progressbar" style="width: 25%" aria-valuenow="25"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4>Vida</h4>
                    <div class="d-flex">
                        <span class="ttl_detalle href_bd_freemium">Ver detalle</span><span class="ttl_number">10</span>
                    </div>
                    <div class="progress">
                        <div class="progress-bar navy" role="progressbar" style="width: 25%" aria-valuenow="25"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4>Legalizados</h4>
                    <div class="d-flex">
                        <span class="ttl_detalle href_bd_freemium">Ver detalle</span><span class="ttl_number">10</span>
                    </div>
                    <div class="progress">
                        <div class="progress-bar navy" role="progressbar" style="width: 25%" aria-valuenow="25"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4>Plataformas</h4>
                    <div class="d-flex">
                        <span class="ttl_detalle href_bd_freemium">Ver detalle</span><span class="ttl_number">10</span>
                    </div>
                    <div class="progress">
                        <div class="progress-bar navy" role="progressbar" style="width: 25%" aria-valuenow="25"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4>Residénciales</h4>
                    <div class="d-flex">
                        <span class="ttl_detalle href_bd_freemium">Ver detalle</span><span class="ttl_number">10</span>
                    </div>
                    <div class="progress">
                        <div class="progress-bar navy" role="progressbar" style="width: 25%" aria-valuenow="25"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card atc_cards">
                    <h1>Atención clientes</h1>
                    <p>16 / <span>12%</span></p>
                    <h4>Reportar atención de asesor</h4>
                    <div class="d-flex">
                        <span class="ttl_detalle href_bd_freemium">Ver detalle</span><span class="ttl_number">10</span>
                    </div>
                    <div class="progress">
                        <div class="progress-bar orange" role="progressbar" style="width: 25%" aria-valuenow="25"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4>Revisión renovación póliza</h4>
                    <div class="d-flex">
                        <span class="ttl_detalle href_bd_freemium">Ver detalle</span><span class="ttl_number">10</span>
                    </div>
                    <div class="progress">
                        <div class="progress-bar orange" role="progressbar" style="width: 25%" aria-valuenow="25"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4>Cancelación de producto</h4>
                    <div class="d-flex">
                        <span class="ttl_detalle href_bd_freemium">Ver detalle</span><span class="ttl_number">10</span>
                    </div>
                    <div class="progress">
                        <div class="progress-bar orange" role="progressbar" style="width: 25%" aria-valuenow="25"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4>Checar fechas de vigencia</h4>
                    <div class="d-flex">
                        <span class="ttl_detalle href_bd_freemium">Ver detalle</span><span class="ttl_number">10</span>
                    </div>
                    <div class="progress">
                        <div class="progress-bar orange" role="progressbar" style="width: 25%" aria-valuenow="25"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
            <div class="col-3 pr-0">
                <div class="card atc_cards">
                    <h1>Dudas de cobranza</h1>
                    <p>22 / <span>25%</span></p>
                    <h4>Seguimiento pago</h4>
                    <div class="d-flex">
                        <span class="ttl_detalle href_bd_freemium">Ver detalle</span><span class="ttl_number">10</span>
                    </div>
                    <div class="progress">
                        <div class="progress-bar yellow" role="progressbar" style="width: 25%" aria-valuenow="25"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4>Reembolsos</h4>
                    <div class="d-flex">
                        <span class="ttl_detalle href_bd_freemium">Ver detalle</span><span class="ttl_number">10</span>
                    </div>
                    <div class="progress">
                        <div class="progress-bar yellow" role="progressbar" style="width: 25%" aria-valuenow="25"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4>Aclaración pagos</h4>
                    <div class="d-flex">
                        <span class="ttl_detalle href_bd_freemium">Ver detalle</span><span class="ttl_number">10</span>
                    </div>
                    <div class="progress">
                        <div class="progress-bar yellow" role="progressbar" style="width: 25%" aria-valuenow="25"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4>Realizar pago</h4>
                    <div class="d-flex">
                        <span class="ttl_detalle href_bd_freemium">Ver detalle</span><span class="ttl_number">10</span>
                    </div>
                    <div class="progress">
                        <div class="progress-bar yellow" role="progressbar" style="width: 25%" aria-valuenow="25"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>