let btnDetallesDirecto = $('.detail-live');
let modalBody = document.getElementById('parent-container');
let btnFiltros = document.getElementById('btnFiltros');
let filtros = document.getElementById('menu-filter');
let optChoose = document.querySelectorAll('.filter-opt-sel');
let applyFiltro = document.getElementById('filtrar');

btnFiltros.addEventListener('click', function() {
    if(filtros.classList.contains('d-none')) {
        filtros.classList.remove('d-none');
        filtros.classList.add('fadeIn');
        document.body.children[0].children[3].classList.add('ovx-ay');
    } else {
        filtros.classList.add('d-none');
        document.body.children[0].children[3].classList.remove('ovx-ay');
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

$(function() {
    var start = moment().subtract(29, 'days');
    var end = moment();
    function cb(start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    }
    $('#reportrange').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
           'Today': [moment(), moment()],
        //    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        //    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
        //    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
        //    'This Month': [moment().startOf('month'), moment().endOf('month')],
        //    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, cb);
    cb(start, end);
});

btnDetallesDirecto.click(function() {
    switch (this.getAttribute('data-content-type')) {
        case 'audio':
            let elemAudio = `<audio src="${this.getAttribute('data-url-content')}" controls></audio>`;
            modalBody.innerHTML = elemAudio;
            console.log(modalBody);
            $('#content').modal('show');
            break;
        case 'video':
            let elemVideo = `<img src="${this.getAttribute('data-url-content')}"></img>`;
            modalBody.innerHTML = elemVideo;
            console.log(modalBody);
            $('#content').modal('show');
            break;
        case 'chat':
            let elemChat = `<img src="${this.getAttribute('data-url-content')}"></img>`;
            modalBody.innerHTML = elemChat;
            console.log(modalBody);
            $('#content').modal('show');
            break;
        default:
            break;
    }
})