let selectFirstTip = document.getElementById('statusGestion');
let selectSecondTip = document.getElementById('ultimaTip');
let selectThirdTip = document.getElementById('subtip');
let optRegistrosEfectivos = ['Selecciona una opción', 'Agenda Llamada', 'No acepta renovación'];
let optRegistrosGestion = ['Selecciona una opción','Número equivocado', 'Tel. Inexistente', 'Sin número telefónico', 'Póliza Cancelada', 'Póliza pagada previamente'];
let optRegistrosNoContacto = ['Selecciona una opción','No contesta', 'Buzón'];
let optRenovacion = ['Agenda promesa de pago', 'Paga en línea', 'Se envía de depósito'];
let optAgendaLlamada = ['Contacto con terceros', 'Asegurado esta indispuesto', 'Llamar más tarde'];
let optNoRenovacion = ['Venta del auto', 'Mal servicio de Mapfre', 'Mal servicio de proveedor', 'Cambio de aseguradora', 'Alto costo', 'Queja'];

selectFirstTip.addEventListener('change', function() {
    switch (selectFirstTip.value) {
        case '1':
            selectSecondTip.removeAttribute('disabled');
            selectSecondTip.innerHTML = '';
            optRegistrosGestion.forEach(function(element, index) {
                let regEf = document.createRange().createContextualFragment(`<option value="${index}">${element}</option>`);
                selectSecondTip.append(regEf);
            });
            selectSecondTip.addEventListener('change', function() {
                switch (this.value) {
                    case '1':
                        selectThirdTip.removeAttribute('disabled');
                        selectThirdTip.innerHTML = '';
                        let numEquiv = document.createRange().createContextualFragment(`<option value="0">Tel. no corresponde a NA</option>`);
                        selectThirdTip.append(numEquiv);
                        break;
                    case '2':
                        selectThirdTip.removeAttribute('disabled');
                        selectThirdTip.innerHTML = '';
                        let telInex = document.createRange().createContextualFragment(`<option value="0">Envío de contrato</option>`);
                        selectThirdTip.append(telInex);
                        break;
                    case '3':
                        selectThirdTip.removeAttribute('disabled');
                        selectThirdTip.innerHTML = '';
                        let noNumber = document.createRange().createContextualFragment(`<option value="0">Envío de contrato</option>`);
                        selectThirdTip.append(noNumber);
                        break;
                    case '4':
                        selectThirdTip.removeAttribute('disabled');
                        selectThirdTip.innerHTML = '';
                        let polizaCancelada = document.createRange().createContextualFragment(`<option value="0">No marcar</option>`);
                        selectThirdTip.append(polizaCancelada);
                        break;
                    case '5':
                        selectThirdTip.removeAttribute('disabled');
                        selectThirdTip.innerHTML = '';
                        let polizaPagada = document.createRange().createContextualFragment(`<option value="0">No marcar</option>`);
                        selectThirdTip.append(polizaPagada);
                        break;
                    default:
                        break;
                }
            });
        break;
        case '2':
            selectSecondTip.removeAttribute('disabled');
            selectSecondTip.innerHTML = '';
            optRegistrosNoContacto.forEach(function(element, index) {
                let regEf = document.createRange().createContextualFragment(`<option value="${index}">${element}</option>`);
                selectSecondTip.append(regEf);
            });
            selectThirdTip.setAttribute('disabled', true);
        break;
        case '0':
            selectSecondTip.removeAttribute('disabled');
            selectSecondTip.innerHTML = '';
            optRegistrosEfectivos.forEach(function(element, index) {
                let regEf = document.createRange().createContextualFragment(`<option value="${index}">${element}</option>`);
                selectSecondTip.append(regEf);
            });
            selectSecondTip.addEventListener('change', function() {
                switch (this.value) {
                    case '1':
                        selectThirdTip.removeAttribute('disabled');
                        selectThirdTip.innerHTML = '';
                        optAgendaLlamada.forEach(function(element, index) {
                            let agendaLlamada = document.createRange().createContextualFragment(`<option value="${index}">${element}</option>`);
                            selectThirdTip.append(agendaLlamada);
                        });
                        break;
                    case '2':
                        selectThirdTip.removeAttribute('disabled');
                        selectThirdTip.innerHTML = '';
                        optNoRenovacion.forEach(function(element, index) {
                            let agendaLlamada = document.createRange().createContextualFragment(`<option value="${index}">${element}</option>`);
                            selectThirdTip.append(agendaLlamada);
                        });
                        break;
                    default:
                        break;
                }
            });
        break;
    }
});