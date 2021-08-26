let videoCap = document.getElementById('videoProbe');

$('#video').on('show.bs.modal', function (e) {
    videoCap.play();
});

$('#video').on('hidden.bs.modal', function (e) {
    stopVideo();
});

function stopVideo() {
    videoCap.pause();
    videoCap.currentTime = 0;
}