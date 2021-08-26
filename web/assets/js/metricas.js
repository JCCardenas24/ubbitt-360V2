let btnFiltros = document.getElementById('btnFiltros');
let filtros = document.getElementById('menu-filter');
let optChoose = document.querySelectorAll('.filter-opt-sel');
let applyFiltro = document.getElementById('filtrar');

btnFiltros.addEventListener('click', function() {
    if(filtros.classList.contains('d-none')) {
        filtros.classList.remove('d-none');
        filtros.classList.add('fadeIn');
        document.body.children[0].children[3].classList.add('ovx-am');
    } else {
        filtros.classList.add('d-none');
        document.body.children[0].children[3].classList.remove('ovx-am');
    }
});

optChoose.forEach(element => {
    element.addEventListener('click', function() {
        if (this.classList.contains('c-gray')) {
            this.classList.remove('c-gray');
            this.classList.add('active-color');
        } else {
            this.classList.add('c-gray');
            this.classList.remove('active-color');
        }
    })
});

applyFiltro.addEventListener('click', function() {
    filtros.classList.add('d-none');
    document.body.children[0].children[3].classList.remove('ovx-ay');
});
