let blockVentas = document.getElementById('ventas');
let blockUsuarios = document.getElementById('usuarios');
let blockClientes = document.getElementById('clientes');
let blockAgenda = document.getElementById('agenda');
let blockCapacitacion = document.getElementById('capacitacion');
let blockMetricas = document.getElementById('metricas');
let blockMail = document.getElementById('mailBlock');
let blockCalendario = document.getElementById('calendario');
let blockTelefono = document.getElementById('telefonoBlock');
let blockChat = document.getElementById('chatBlock');
let blockVideo = document.getElementById('videollamadaBlock');
let optBanTel = document.getElementById('bandejaCotTel');
let optBanChat = document.getElementById('bandejaCotChat');
let optBanMail = document.getElementById('bandejaMail');
let optBanVideo = document.getElementById('bandejaVideo');
let btnLeads = document.querySelector('.btn-atend');

blockVentas.addEventListener('click', function() {
    window.location.href = 'ventas.php';
});

btnLeads.addEventListener('click', function() {
    window.location.href = 'leads.php';
});

blockUsuarios.addEventListener('click', function() {
    window.location.href = 'usuario.php';
});

blockClientes.addEventListener('click', function() {
    window.location.href = 'clientes.php';
});

blockAgenda.addEventListener('click', function() {
    window.location.href = 'agenda.php';
});

blockCapacitacion.addEventListener('click', function() {
    window.location.href = 'capacitacion.php';
});

blockMetricas.addEventListener('click', function() {
    window.location.href = 'metricas.php';
});

blockMail.addEventListener('click', function() {
    window.location.href = 'mail.php';
});

blockCalendario.addEventListener('click', function() {
    window.location.href = 'calendario.php';
});

blockTelefono.addEventListener('click', function() {
    window.location.href = 'telefono.php';
});

blockChat.addEventListener('click', function() {
    window.location.href = 'chat.php';
});

blockVideo.addEventListener('click', function() {
    window.location.href = 'videollamada.php'
});

optBanTel.addEventListener('click', function() {
    window.location.href = 'llamada/venta-nueva/saludo.php';
});

optBanChat.addEventListener('click', function() {
    window.location.href = 'cotizacion-chat.php';
});

optBanMail.addEventListener('click', function() {
    window.location.href = 'mail.php';
});

optBanVideo.addEventListener('click', function() {
    window.location.href = 'videollamada.php';
});