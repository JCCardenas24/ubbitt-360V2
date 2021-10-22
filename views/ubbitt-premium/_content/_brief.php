<div class="premium-brief-campaign" id="premium-brief-campaign">
    <?php
    if (in_array('action_ubbitt_premium_edit_brief', Yii::$app->session->get("userPermissions"))) {
    ?>
    <button id="btn-edit-brief" class="btn btn-first c-white col-md-2 float-right" onclick="onEnableBriefEdition()"><i
            class="ri-edit-box-line"></i> Editar</button>
    <button id="btn-save-brief" class="btn btn-first c-white col-md-2 ml-3 float-right" style="display: none"
        onclick="onSaveBrief()"><i class="ri-save-line"></i> Guardar</button>
    <button id="btn-cancel-edit-brief" class="btn btn-first c-white col-md-2 float-right" style="display: none"
        onclick="onCancelBriefEdition()">Cancelar Edición</button>
    <?php } ?>
    <h1><span><img src="<?= Yii::getAlias('@web') ?>/assets/images/campana.svg" alt=""></span> Detalles generales de la
        campaña</h1>
    <hr>
    <h5>Tipo de Industria</h5>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="brief-industry-type" id="brief-industry-type-insurance"
            value="insurance" disabled>
        <label class="form-check-label" for="brief-industry-type-insurance">Seguros</label>
    </div>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="brief-industry-type"
            id="brief-industry-type-telecommunications" value="telecommunications" disabled>
        <label class="form-check-label" for="brief-industry-type-telecommunications">Telecomunicaciones</label>
    </div>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="brief-industry-type" id="brief-industry-type-services"
            value="services" disabled>
        <label class="form-check-label" for="brief-industry-type-services">Servicios</label>
    </div>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="brief-industry-type" id="brief-industry-type-financial"
            value="financial" disabled>
        <label class="form-check-label" for="brief-industry-type-financial">Financieros</label>
    </div>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="brief-industry-type" id="brief-industry-type-commerce"
            value="commerce" disabled>
        <label class="form-check-label" for="brief-industry-type-commerce">Comercio</label>
    </div>
    <div class="row details_campaigns">
        <div class="col-6">
            <div class="form-group">
                <label for="campaign-name">Nombre de la campaña</label>
                <input type="text" class="form-control" id="campaign-name" placeholder="SEGURO DE AUTO" disabled>
            </div>
            <div class="form-group">
                <label for="product-insights">Insights del producto</label>
                <input type="text" class="form-control" id="product-insights" placeholder="Nombre campaña" disabled>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="product-description">Descripción del producto</label>
                <input type="text" class="form-control" id="product-description"
                    placeholder="Describe brevemente tu producto o servicio" disabled>
            </div>
            <div class="form-group">
                <label for="product-added-value">¿Cuál es el valor agregado del producto?</label>
                <input type="text" class="form-control" id="product-added-value"
                    placeholder="Describe brevemente tu producto o servicio" disabled>
            </div>
        </div>
    </div>
    <h1><span><img src="<?= Yii::getAlias('@web') ?>/assets/images/producto.svg" alt=""></span> Descripción de venta del
        producto o servicio</h1>
    <hr>
    <div class="row details_campaigns">
        <div class="col-6">
            <div class="form-group">
                <label for="product-average-price">Precio promedio del producto/servicio</label>
                <div class="wrapper_input_number_custom">
                    <button class="btn mr-2" id="dec-product-average-price" disabled>-</button>
                    <input type="text" class="form-control input_number_custom" id="product-average-price"
                        placeholder="$0.00" disabled>
                    <button class="btn ml-2 inc_amount" id="inc-product-average-price" disabled>+</button>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="product-first-payment-average-price">Precio promedio del primer pago del producto/ servicio
                </label>
                <div class="wrapper_input_number_custom">
                    <button class="btn mr-2" id="dec-product-first-payment-average-price" disabled>-</button>
                    <input type="text" class="form-control input_number_custom" id="product-first-payment-average-price"
                        placeholder="$0.00" disabled>
                    <button class="btn ml-2 inc_amount" id="inc-product-first-payment-average-price" disabled>+</button>
                </div>
            </div>
        </div>
    </div>
    <h5>Periodicidad del pago del producto/servicio</h5>
    <div class="row ml-0 mr-0">
        <div class="col">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="payment-frequency-yearly" value="1" disabled>
                <label class="form-check-label" for="payment-frequency-yearly">Anual</label>
            </div>
        </div>
        <div class="col">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="payment-frequency-biannual" value="1" disabled>
                <label class="form-check-label" for="payment-frequency-biannual">Semestral</label>
            </div>
        </div>
        <div class="col">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="payment-frequency-quarterly" value="1" disabled>
                <label class="form-check-label" for="payment-frequency-quarterly">Trimestral</label>
            </div>
        </div>
        <div class="col">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="payment-frequency-monthly" value="1" disabled>
                <label class="form-check-label" for="payment-frequency-monthly">Mensual</label>
            </div>
        </div>
    </div>
    <br>
    <h5>Tipos de pago utilizados para la venta del producto / servicio </h5>
    <div class="row ml-0 mr-0">
        <div class="col">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="payment-type-cash" value="1" disabled>
                <label class="form-check-label" for="payment-type-cash">Contado</label>
            </div>
        </div>
        <div class="col">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="payment-type-card-months-without-interest" value="1"
                    disabled>
                <label class="form-check-label" for="payment-type-card-months-without-interest">Tarjeta Meses sin
                    intereses</label>
            </div>
        </div>
        <div class="col">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="payment-type-card-single-payment" value="1"
                    disabled>
                <label class="form-check-label" for="payment-type-card-single-payment">Tarjeta Una sola
                    exhibición</label>
            </div>
        </div>
        <div class="col"></div>
    </div>
    <br>
    <h5>Métodos de pago utilizados para la venta del producto / servicio </h5>
    <div class="row ml-0 mr-0">
        <div class="col">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="payment-method-card" value="1" disabled>
                <label class="form-check-label" for="payment-method-card">Tarjeta Crédito/Débito</label>
            </div>
        </div>
        <div class="col">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="payment-method-cash-pickup" value="1" disabled>
                <label class="form-check-label" for="payment-method-cash-pickup">Pago en ventanilla</label>
            </div>
        </div>
        <div class="col">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="payment-method-wire-transfer" value="1" disabled>
                <label class="form-check-label" for="payment-method-wire-transfer">Transferencia</label>
            </div>
        </div>
        <div class="col"></div>
    </div>
    <br>
    <h1><span><img src="<?= Yii::getAlias('@web') ?>/assets/images/inversion.svg" alt=""></span> Inversión y
        periodicidad de campaña Ubbitt</h1>
    <hr>
    <div class="row details_campaigns">
        <div class="col-6">
            <div class="form-group">
                <label for="investment">Inversión</label>
                <div class="wrapper_input_number_custom">
                    <button class="btn mr-2" id="dec-investment" disabled>-</button>
                    <input type="text" class="form-control input_number_custom" id="investment" placeholder="$350,000"
                        disabled>
                    <button class="btn ml-2 inc_amount" id="inc-investment" disabled>+</button>
                </div>
                <small>Nota: Inversión mínima de $350,000</small>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="start-date">Fecha de inicio</label>
                <input type="text" class="form-control singlerange" id="start-date" placeholder="DD/MM/AAAA" disabled>
            </div>
            <div class="form-group">
                <label for="end-date">Finalización</label>
                <input type="text" class="form-control singlerange" id="end-date" placeholder="DD/MM/AAAA" disabled>
            </div>
        </div>
    </div>
    <h1><span><img src="<?= Yii::getAlias('@web') ?>/assets/images/inversion.svg" alt=""></span> Inversión y
        periodicidad de campaña Ubbitt 2</h1>
    <hr>
    <div class="row details_campaigns">
        <div class="col-6">
            <div class="form-group">
                <label for="investment">Inversión</label>
                <input type="text" class="form-control" id="investment" placeholder="$350,000" valie="$350,000"
                    disabled>
                <small>Nota: Inversión mínima de $350,000</small>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="start-date">Fecha de inicio</label>
                <input type="text" class="form-control" id="start-date" placeholder="" value="27/09/2021" disabled>
            </div>
            <div class="form-group">
                <label for="end-date">Finalización</label>
                <input type="text" class="form-control" id="end-date" placeholder="" value="27/10/21" disabled>
            </div>
        </div>
    </div>
    <!-- <div class="row details_campaigns mt-0">
        <div class="col-6">
            <div class="form-group">
                <label for="expected-bidding-per-lead">Bidding por lead esperado </label>
                <div class="wrapper_input_number_custom">
                    <button class="btn mr-2" id="dec-expected-bidding-per-lead" disabled>-</button>
                    <input type="text" class="form-control input_number_custom" id="expected-bidding-per-lead"
                        placeholder="$80.00" disabled>
                    <button class="btn ml-2 inc_amount" id="inc-expected-bidding-per-lead" disabled>+</button>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="expected-total-sales">Ventas totales esperadas </label>
                <div class="wrapper_input_number_custom">
                    <button class="btn mr-2" id="dec-expected-total-sales" disabled>-</button>
                    <input type="text" class="form-control input_number_custom" id="expected-total-sales"
                        placeholder="2000" disabled>
                    <button class="btn ml-2 inc_amount" id="inc-expected-total-sales" disabled>+</button>
                </div>
            </div>
        </div>
    </div> -->
</div>