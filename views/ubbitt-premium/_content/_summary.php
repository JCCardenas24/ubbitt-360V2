<div class="d-flex justify-content-end mb-20">
    <div class="d-flex justify-content-end ">
        <div class=" d-flex justify-content-between">
            <div class="form-group wid-100 d-flex m-0">
                <div id="premium-summary-date-range" class="range-pick mr-5">
                    <i class="fa fa-calendar"></i>&nbsp;
                    <span class="text-date"></span>&nbsp;&nbsp;<i class="fa fa-caret-down"></i>
                </div>
            </div>
        </div>
        <!-- <a href="#" class="pdf_button mr-5"><i class="icon-download_xls"></i></a> -->
    </div>
</div>

<div class="row ml-0 mr-0 row_balance_resumen">
    <div class="col">
        <div class="card dark-gray">
            <p>Inversión Ubbitt</p>
            <h5 id="ubbitt-investment">$0</h5>
        </div>
    </div>
    <div class="col">
        <div class="card dark-gray">
            <p>Presupuesto gastado</p>
            <h5 id="spent-budget">$0</h5>
        </div>
    </div>
    <div class="col">
        <div class="card gray">
            <p>ROI</p>
            <h5 id="roi">$0</h5>
        </div>
    </div>
    <div class="col">
        <div class="card gray">
            <p>ROI</p>
            <h5 id="roi-percentage">0%</h5>
        </div>
    </div>
    <div class="col">
        <div class="card orange">
            <p>CPL</p>
            <h5 id="cpl">$0</h5>
        </div>
    </div>
    <div class="col">
        <div class="card yellow">
            <p>CPA</p>
            <h5 id="cpa">$0</h5>
        </div>
    </div>
    <div class="col">
        <div class="card yellow">
            <p>CPA</p>
            <h5 id="cpa-percentage">0%</h5>
        </div>
    </div>
</div>

<div class="row ml-0 mr-0 card_actual_forecast">
    <div class="col-4">
        <div class="balance_inversion_ventas_cobrado">
            <div class="card_ttls row ml-0 mr-0">
                <div class="col-6 p-0 lr">
                    <h2>Actual</h2>
                </div>
                <div class="col-6 p-0 lf">
                    <h3>Forecast</h3>
                </div>
            </div>
            <div class="row balance_info_forecast_actual ml-0 mr-0">
                <div class="col-6 lr">
                    <h2 id="actual-investment">$0</h2>
                </div>
                <div class="col-6 lf">
                    <h3 id="forecast-investment">$0</h3>
                </div>
                <div class="ttl_wrapper_forecast_actual">
                    <p>Inversión</p>
                </div>
            </div>
            <div class="row balance_info_forecast_actual ml-0 mr-0">
                <div class="col-6 lr">
                    <h2 id="actual-sales">$0</h2>
                </div>
                <div class="col-6 lf">
                    <h3 id="forecast-sales">$0</h3>
                </div>
                <div class="ttl_wrapper_forecast_actual">
                    <p>Ventas</p>
                </div>
            </div>
            <div class="row balance_info_forecast_actual ml-0 mr-0 border_radius_bottom">
                <div class="col-6 lr">
                    <h2 id="actual-collected">$0</h2>
                </div>
                <div class="col-6 lf">
                    <h3 id="forecast-collected">$0</h3>
                </div>
                <div class="ttl_wrapper_forecast_actual">
                    <p>Cobrado</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-8">
        <div class="radio_button_forecast_actual">
            <input type="checkbox" value="false" name="selected_chart" id="pemp_yes" checked>
            <label for="pemp_yes">Actual</label>
            <input type="checkbox" value="true" name="selected_chart" id="pemp_no">
            <label for="pemp_no">Forecast</label>
        </div>
        <div class="chart_actual">
            <div id="summary-graph" style="height:400px;"></div>
        </div>
    </div>
</div>

<div class="row ml-0 mr-0 mt-30 mb-30">
    <div class="col">
        <div class="gray_gradient_card">

            <i class="ri-arrow-up-line"></i>
            <div>
                <small>LEADS</small>
                <h5 id="leads">0</h5>
            </div>

        </div>
    </div>
    <div class="col">
        <div class="gray_gradient_card">

            <i class="ri-arrow-up-line"></i>
            <div>
                <small>TOTAL LLAMADAS</small>
                <h5 id="calls-total">0</h5>
            </div>

        </div>
    </div>
    <div class="col">
        <div class="gray_gradient_card">

            <i class="ri-arrow-up-line"></i>
            <div>
                <small>TOTAL VENTAS</small>
                <h5 id="sales-total">0</h5>
            </div>

        </div>
    </div>
    <div class="col">
        <div class="gray_gradient_card">

            <i class="ri-arrow-up-line"></i>
            <div>
                <small>CONVERSIÓN</small>
                <h5 id="conversion-percentage">0%</h5>
            </div>

        </div>
    </div>
    <div class="col">
        <div class="gray_gradient_card">

            <i class="ri-arrow-up-line"></i>
            <div>
                <small>TOTAL COBROS</small>
                <h5 id="collected-total">0</h5>
            </div>

        </div>
    </div>
    <div class="col">
        <div class="gray_gradient_card">

            <i class="ri-arrow-up-line"></i>
            <div>
                <small>% DE COBRANZA</small>
                <h5 id="collected-percentage">0%</h5>
            </div>

        </div>
    </div>
</div>

<div class="row ml-0 mr-0 row_behavior_campaigns">
    <div class="col-6">
        <div class="row ml-0 mr-0 card">
            <div class="col-6">
                <div class="funnel_chart" id="funel_inversiones_ventas_chart" style="height:360px;"></div>
            </div>
            <div class="col-6">
                <div class="height_info_chart">
                    <div class="level_chart">
                        <p>Inversión total</p>
                        <h1 id="spent-investment">$0</h1>
                        <hr class="top">
                        <hr>
                    </div>
                    <div class="level_chart">
                        <p>Total de ventas</p>
                        <h1 id="sales-total-amount">$0</h1>
                        <small id="sales-percentage">0%</small>
                        <hr>
                    </div>
                    <div class="level_chart">
                        <p>Total de cobros</p>
                        <h1 id="collected-total-amount">$0</h1>
                        <small id="collection-percentage">0%</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="card">
            <div id="behavior-campaign-stacked-line" style="height:360px;"></div>
        </div>
    </div>
</div>

<div class="row ml-0 mr-0 row_ventas_campaigns">
    <div class="col-6">
        <div class="card card_1">
            <div id="premium_resumen_concentrado_ventas_chart" style="height: 300px;"></div>
        </div>
    </div>
    <div class="col-6">
        <div class="card card_2">
            <p>Venta emitida total</p>
            <h5 id="total-emitted-sales">$0</h5>
        </div>
        <div class="card card_2">
            <p>Venta pagada total</p>
            <h5 id="total-paid-sales">$0</h5>
        </div>
    </div>
</div>