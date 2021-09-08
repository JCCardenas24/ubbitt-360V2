let radioBtnCeroTolSi = document.getElementById('siCeroTol');
let radioBtnCeroTolNo = document.getElementById('noCeroTol');

radioBtnCeroTolNo.addEventListener('change', function() {
    if(this.checked = true) {
        document.getElementById('selOptCeroTol').classList.add('d-hide');
    }
});

radioBtnCeroTolSi.addEventListener('change', function() {
    if(this.checked = true) {
        document.getElementById('selOptCeroTol').classList.remove('d-hide');
    }
});