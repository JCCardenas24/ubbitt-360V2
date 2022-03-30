<div class="d-flex justify-content-end mb-20">
    <div class="d-flex justify-content-end ">
        <div class=" d-flex justify-content-between">
            <div class="form-group wid-100 d-flex m-0">
                <div id="premium-marketing-general-date-range" class="range-pick mr-5">
                    <i class="fa fa-calendar"></i>&nbsp;
                    <span class="text-date"></span>&nbsp;&nbsp;<i class="fa fa-caret-down"></i>
                </div>
            </div>
        </div>
        <!-- <a href="#" class="pdf_button mr-5"><i class="icon-download_xls"></i></a> -->
    </div>
</div>

<div class="row presupuestos-row ml-0 mr-0">
    <!-- <div class="col p-0 d-fjcc br">
        <div class="card_info ">
            <p>Presupuesto</p>
            <h5 id="marketing-budget">$0</h5>
        </div>
    </div> -->
    <div class="col p-0 d-fjcc br">
        <div class="card_info ">
            <p>Presupuesto gastado</p>
            <h5 id="marketing-spent-budget">$0</h5>
        </div>
    </div>
    <div class="col p-0 d-fjcc br">
        <div class="card_info pink_bg">

            <p>% presupuesto gastado</p>
            <h5 id="marketing-spent-budget-percentage">0%</h5>

        </div>
    </div>
    <div class="col p-0 d-fjcc br">
        <div class="card_info">
            <p>Presupuesto disponible</p>
            <h5 id="marketing-available-budget">$0</h5>
        </div>
    </div>
    <div class="col p-0 d-fjcc">
        <div class="card_info pink_bg">

            <p>% Presupuesto disponible</p>
            <h5 id="marketing-available-budget-percentage">0%</h5>

        </div>
    </div>
</div>

<div class="container_custom_chart">
    <div class="row ml-0 mr-0 row_conectores">
        <div class="wrapper_conector">
            <div class="card_conector">
                <a type="button" class="tooltip_btn" data-toggle="tooltip" data-placement="left" data-html="true"
                    title="La tasa de clics <br> (clics ÷ impresiones= CTR)">
                    <i class="ri-information-fill"></i>
                </a>
                <div>
                    <p>CTR
                    <p>
                    <h1 id="marketing-ctr">0%</h1>
                </div>
            </div>
            <img src="<?= Yii::getAlias('@web') ?>/assets/images/conector.svg" alt="">
        </div>
        <div class="wrapper_conector">
            <div class="card_conector">
                <a type="button" class="tooltip_btn" data-toggle="tooltip" data-placement="left" data-html="true"
                    title="El porcentaje de rebote mide las visitas en las que el usuario ha abandonado el micrositio = (el número de vistas / el número de clicks)">
                    <i class="ri-information-fill"></i>
                </a>
                <div>
                    <p>Rebote
                    <p>
                    <h1 id="marketing-rebound">0%</h1>
                </div>
            </div>
            <img src="<?= Yii::getAlias('@web') ?>/assets/images/conector.svg" alt="">
        </div>
        <div class="wrapper_conector">
           <!--  <div class="card_conector">
                <a type="button" class="tooltip_btn" data-toggle="tooltip" data-placement="left" data-html="true"
                    title="Leads/Vistas">
                    <i class="ri-information-fill"></i>
                </a>
                <div>
                    <p>Conversión
                    <p>
                    <h1 id="marketing-visits-conversion">0%</h1>
                </div>
            </div>
            <img src="<?= Yii::getAlias('@web') ?>/assets/images/conector.svg" alt=""> -->
        </div>
        <div class="wrapper_conector">
            <!-- <div class="card_conector">
                <a type="button" class="tooltip_btn" data-toggle="tooltip" data-placement="left" data-html="true"
                    title="Conectados/Leads">
                    <i class="ri-information-fill"></i>
                </a>
                <div>
                    <p>Conversión
                    <p>
                    <h1 id="marketing-leads-conversion">0%</h1>
                </div>
            </div>
            <img src="<?= Yii::getAlias('@web') ?>/assets/images/conector.svg" alt=""> -->
        </div>
        <div class="wrapper_conector mr-0">
            <div class="card_conector">
                <a type="button" class="tooltip_btn" data-toggle="tooltip" data-placement="left" data-html="true"
                    title="Ventas/Contactados">
                    <i class="ri-information-fill"></i>
                </a>
                <div>
                    <p>Conversión
                    <p>
                    <h1 id="marketing-contacting-conversion">0%</h1>
                </div>
            </div>
            <img src="<?= Yii::getAlias('@web') ?>/assets/images/conector.svg" alt="">
        </div>
    </div>

    <div class="row ml-0 mr-0 row_triangles">
        <div class="col w_16_6">
            <div class="card_yellow">
                <a type="button" class="tooltip_btn" data-toggle="tooltip" data-placement="left" data-html="true"
                    title="Son la métrica que refleja el número de veces que se muestra un contenido.">
                    <i class="ri-information-fill"></i>
                </a>
                <div>
                    <p>Impresiones</p>
                    <h1 id="marketing-impressions">0</h1>
                </div>
            </div>
            <span class="mini_triangle_yellow"></span>
        </div>
        <div class="col w_16_6">
            <div class="card_gray">
                <a type="button" class="tooltip_btn" data-toggle="tooltip" data-placement="left" data-html="true"
                    title="El clics  determina la interacción del usuario con el contenido.">
                    <i class="ri-information-fill"></i>
                </a>
                <div>
                    <p>Clics</p>
                    <h1 id="marketing-clicks">0</h1>
                </div>
            </div>
            <span class="mini_triangle_gray"></span>
        </div>
        <div class="col w_16_6">
            <div class="card_gray">
                <a type="button" class="tooltip_btn" data-toggle="tooltip" data-placement="left" data-html="true"
                    title="Una visita es el número de veces que un visitante único entra al micrositio.">
                    <i class="ri-information-fill"></i>
                </a>
                <div>
                    <p>Visitas</p>
                    <h1 id="marketing-visits">0</h1>
                </div>
            </div>
            <span class="mini_triangle_gray"></span>
        </div>
        <div class="col w_16_6">
            <div class="card_gray">
                <a type="button" class="tooltip_btn" data-toggle="tooltip" data-placement="left" data-html="true"
                    title="Clientes potenciales generados en el período de tiempo seleccionado.">
                    <i class="ri-information-fill"></i>
                </a>
                <div>
                    <p>Leads</p>
                    <h1 id="marketing-leads">0</h1>
                </div>
            </div>
            <span class="mini_triangle_gray"></span>
        </div>
        <div class="col w_16_6">
            <div class="card_gray">
                <a type="button" class="tooltip_btn" data-toggle="tooltip" data-placement="left" data-html="true"
                    title="Son los clientes potenciales que sus datos permite contactación.">
                    <i class="ri-information-fill"></i>
                </a>
                <div>
                    <p>Contactación</p>
                    <h1 id="marketing-contacting">0</h1>
                </div>
            </div>
            <span class="mini_triangle_gray"></span>
        </div>
        <div class="col w_16_6">
            <div class="card_orange">
                <a type="button" class="tooltip_btn" data-toggle="tooltip" data-placement="left" data-html="true"
                    title="Número de pólizas emitidas en el período seleccionado.">
                    <i class="ri-information-fill"></i>
                </a>
                <div>
                    <p>Ventas</p>
                    <h1 id="marketing-sales">0</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="row ml-0 mr-0 row_bottom_cards">
       <!--  <div class="col p-0">
            <div class="card_bottom bottom_card_yellow">
                <a type="button" class="tooltip_btn" data-toggle="tooltip" data-placement="left" data-html="true"
                    title="Costo por cada mil impresiones.">
                    <i class="ri-information-fill"></i>
                </a>
                <div>
                    <p>CPM</p>
                    <h1 id="marketing-cpm">$0</h1>
                </div>
            </div>
        </div>
        <div class="col p-0">
            <div class="card_bottom bottom_card_gray">
                <a type="button" class="tooltip_btn" data-toggle="tooltip" data-placement="left" data-html="true"
                    title="Costo por clic  es la cantidad que gasta cada vez que un usuario hace clic en un anuncio.">
                    <i class="ri-information-fill"></i>
                </a>
                <div>
                    <p>CPC</p>
                    <h1 id="marketing-cpc">$0</h1>
                </div>
            </div>
        </div>
        <div class="col p-0">
            <div class="card_bottom bottom_card_gray">
                <div>
                    <p>CP Vista</p>
                    <h1 id="marketing-cp-visit">$0</h1>
                </div>
            </div>
        </div>
        <div class="col p-0">
            <div class="card_bottom bottom_card_gray">
                <a type="button" class="tooltip_btn" data-toggle="tooltip" data-placement="left" data-html="true"
                    title="<b>Costo por lead  promedio:</b> <br>Presupuesto total / Número total de leads = CPL.">
                    <i class="ri-information-fill"></i>
                </a>
                <div>
                    <p>CPL</p>
                    <h1 id="marketing-cpl">$0</h1>
                </div>
            </div>
        </div>
        <div class="col p-0">
            <div class="card_bottom bottom_card_gray">
                <a type="button" class="tooltip_btn" data-toggle="tooltip" data-placement="left" data-html="true"
                    title="<b>Costo por lead  promedio contactado:</b> <br> Presupuesto total / Número total de leads contactables = CPL.">
                    <i class="ri-information-fill"></i>
                </a>
                <div>
                    <p>CPL Contactados</p>
                    <h1 id="marketing-cpl-contacted">$0</h1>
                </div>
            </div>
        </div> -->
        <!-- <div class="col p-0">
            <div class="card_bottom bottom_card_orange">
                <div>
                    <p>Costo por venta</p>
                    <h1 id="marketing-sale-cost">$0</h1>
                </div>
            </div>
        </div> -->
    </div>
</div>

<div class="row ml-0 mr-0 row_table_medios">
    <!-- <div class="col-7 pl-0">
        <div class="header_table_medios">
            <h5>Por medio</h5>
        </div>
        <div>
            <table class="table table-striped  mb-0">
                <thead>
                    <tr>
                        <th scope="col">Medio</th>
                        <th scope="col">Impresiones</th>
                        <th scope="col">Clics</th>
                        <th scope="col">Visitas</th>
                        <th scope="col">Leads</th>
                        <th scope="col">Contactados</th>
                        <th scope="col">Ventas</th>
                    </tr>
                </thead>
                <tbody class="table_wrapper scroller" id="media-data">
                </tbody>
            </table>
        </div>
    </div> -->
    <div class="col-6 offset-3 pr-0">
        <div class="card_roa">
            <h1>ROA | <span id="marketing-roa">0%</span></h1>
            <div class="wrapper_bars">
                <p>Ventas | <span id="marketing-sales-amount">$0</span></p>
                <div class="progress">
                    <div id="marketing-sales-bar" class="progress-bar bg_green" role="progressbar" style="width: 0%"
                        aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <p>Gasto | <span id="marketing-expenses">$0</span></p>
                <div class="progress">
                    <div id="marketing-expenses-bar" class="progress-bar bg_orange" role="progressbar" style="width: 0%"
                        aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <p>Inversión | <span id="marketing-investment">$0</span></p>
                <div class="progress">
                    <div id="marketing-investment-bar" class="progress-bar bg_yellow" role="progressbar"
                        style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="wrapper_chart_rendimiento_diario">
    <div id="redimiento_diario_chart_wrapper" style="height: 400px;"></div>
</div>