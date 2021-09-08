let inpFileIden = document.getElementById('identificacion');
let inpFileComprobante = document.getElementById('comprobanteDomicilio');
let inpFileActa = document.getElementById('actaNacimiento');
let inpFileContrato = document.getElementById('contrato');
let btnDeleteIden = document.querySelector('.deleteFileIden');
let btnDeleteComp = document.querySelector('.deleteFileComprobante');
let btnDeleteActa = document.querySelector('.deleteFileActa');
let btnDeleteContr = document.querySelector('.deleteFileContrato');

nameFile(inpFileIden, btnDeleteIden);
nameFile(inpFileComprobante, btnDeleteComp);
nameFile(inpFileActa, btnDeleteActa);
nameFile(inpFileContrato, btnDeleteContr);

btnDeleteIden.addEventListener('click', function() {
    clearInpFile(inpFileIden);
    this.classList.add('d-hide');
});

btnDeleteComp.addEventListener('click', function() {
    clearInpFile(inpFileComprobante);
    this.classList.add('d-hide');
});

btnDeleteActa.addEventListener('click', function() {
    clearInpFile(inpFileActa);
    this.classList.add('d-hide');
});

btnDeleteContr.addEventListener('click', function() {
    clearInpFile(inpFileContrato);
    this.classList.add('d-hide');
});


function nameFile(inpElement, deleteElem) {
    inpElement.addEventListener('change', function(e) {
        let fileName = inpElement.files[0].name;
        let nextSibling = e.target.nextElementSibling;
        nextSibling.innerText = fileName;
        deleteElem.classList.remove('d-hide');
    });
}

function clearInpFile(inpElem) {
    if(inpElem.value != '') {
        inpElem.value = "";
        inpElem.parentNode.children[1].innerText = '';
    }
}