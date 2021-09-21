<div class="premium-brief-campaign">
    <h1><span><img src="<?= Yii::getAlias('@web') ?>/assets/images/campana.svg" alt=""></span> Detalles generales de la
        campaña</h1>
    <hr>
    <h5>Tipo de Industria</h5>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio11" value="option1">
        <label class="form-check-label" for="inlineRadio11">Seguros</label>
    </div>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio22" value="option2">
        <label class="form-check-label" for="inlineRadio22">Telecomunicaciones</label>
    </div>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio33" value="option3">
        <label class="form-check-label" for="inlineRadio33">Servicios</label>
    </div>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
        <label class="form-check-label" for="inlineRadio1">Financieros</label>
    </div>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
        <label class="form-check-label" for="inlineRadio2">Comercio</label>
    </div>
    <div class="row details_campaigns">
        <div class="col-6">
            <div class="form-group">
                <label for="formGroupExampleInput">Nombre de la campaña</label>
                <input type="text" class="form-control" id="formGroupExampleInput" placeholder="SEGURO DE AUTO">
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput">Insights del producto</label>
                <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Nombre campaña">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="formGroupExampleInput">Descripción del producto</label>
                <input type="text" class="form-control" id="formGroupExampleInput"
                    placeholder="Describe brevemente tu producto o servicio">
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput">¿Cuál es el valor agregado del producto?</label>
                <input type="text" class="form-control" id="formGroupExampleInput"
                    placeholder="Describe brevemente tu producto o servicio">
            </div>
        </div>
    </div>
    <h1><span><img src="<?= Yii::getAlias('@web') ?>/assets/images/producto.svg" alt=""></span> Descripción de venta del
        producto o servicio</h1>
    <hr>
    <div class="row details_campaigns">
        <div class="col-6">
            <div class="form-group">
                <label for="formGroupExampleInput">Precio promedio del producto/servicio</label>
                <input type="text" class="form-control" id="formGroupExampleInput" placeholder="$0.00">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="formGroupExampleInput">Precio promedio del primer pago del producto/ servicio </label>
                <input type="text" class="form-control" id="formGroupExampleInput" placeholder="$0.00">
            </div>
        </div>
    </div>
    <h5>Periodicidad del pago del producto/servicio</h5>
    <div class="row ml-0 mr-0">
        <div class="col">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                <label class="form-check-label" for="inlineCheckbox1">Anual</label>
            </div>
        </div>
        <div class="col">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
                <label class="form-check-label" for="inlineCheckbox2">Semestral</label>
            </div>
        </div>
        <div class="col">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="option3">
                <label class="form-check-label" for="inlineCheckbox3">Trimestral</label>
            </div>
        </div>
        <div class="col">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="inlineCheckbox33" value="option33">
                <label class="form-check-label" for="inlineCheckbox33">Mensual</label>
            </div>
        </div>
    </div>
    <br>
    <h5>Tipos de pago utilizados para la venta del producto / servicio </h5>
    <div class="row ml-0 mr-0">
        <div class="col">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="inlineCheckbox111" value="option111">
                <label class="form-check-label" for="inlineCheckbox111">Contado</label>
            </div>
        </div>
        <div class="col">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="inlineCheckbox222" value="option222">
                <label class="form-check-label" for="inlineCheckbox222">Tarjeta Meses sin intereses</label>
            </div>
        </div>
        <div class="col">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="inlineCheckbox333" value="option333">
                <label class="form-check-label" for="inlineCheckbox333">Tarjeta Una sola exhibición</label>
            </div>
        </div>
        <div class="col"></div>
    </div>
    <br>
    <h5>Métodos de pago utilizados para la venta del producto / servicio </h5>
    <div class="row ml-0 mr-0">
        <div class="col">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="inlineCheckbox1111" value="option1111">
                <label class="form-check-label" for="inlineCheckbox1111">Tarjeta Crédito/Débito</label>
            </div>
        </div>
        <div class="col">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="inlineCheckbox2222" value="option2222">
                <label class="form-check-label" for="inlineCheckbox2222">Pago en ventanilla</label>
            </div>
        </div>
        <div class="col">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="inlineCheckbox3333" value="option3333">
                <label class="form-check-label" for="inlineCheckbox3333">Transferencia</label>
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
                <label for="formGroupExampleInput">Inversión</label>
                <input type="text" class="form-control" id="formGroupExampleInput" placeholder="$350,000">
                <small>Nota: Inversión mínima de $350,000</small>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="formGroupExampleInput">Fecha de inicio</label>
                <input type="text" class="form-control" id="formGroupExampleInput" placeholder="">
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput">Finalización</label>
                <input type="text" class="form-control" id="formGroupExampleInput" placeholder="">
            </div>
        </div>
    </div>
    <div class="row details_campaigns mt-0">
        <div class="col-6">
            <div class="form-group">
                <label for="formGroupExampleInput">Bidding por lead esperado </label>
                <input type="text" class="form-control" id="formGroupExampleInput" placeholder="$80.00">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="formGroupExampleInput">Ventas totales esperadas </label>
                <input type="text" class="form-control" id="formGroupExampleInput" placeholder="2000">
            </div>
        </div>
    </div>
</div>