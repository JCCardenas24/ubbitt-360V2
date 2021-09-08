let recordButton = document.getElementById('record');
let buttonOptionBreak = document.querySelectorAll('.option-break');
let modalStartTime = document.getElementById('startTime');

buttonOptionBreak.forEach(element => {
    element.addEventListener('click', function() {
        let activeBreak = document.querySelector('.active-opt');
        if(activeBreak) {
            activeBreak.classList.remove('active-opt');
        }
        this.classList.add('active-opt');
        let divActiveBreak = document.querySelectorAll('.active-opt')[0].id;
        let srcActiveBreak = document.querySelectorAll('.active-opt')[0].children[0].children[0].src;
        let divModalBreak = document.getElementById('bodyBreak');
        switch (divActiveBreak) {
            case 'cafe':
                bodyBreak.children[0].children[0].src = srcActiveBreak;
                let textHeaderBreak =`  <p class="text-uppercase c-header font-size-16 font-weight-900 m-0">tiempo para café | 10 min</p>
                                        <p class="c-header font-size-14 m-0">
                                            Recuerda que el tiempo que no utilices será considerado en el tiempo de tu jornada laboral.
                                        </p>
                                        <p id="timer" class="font-size-70 c-yellow text-center time-container font-weight-900">00:00</p>
                                     `;
                bodyBreak.children[1].innerHTML = textHeaderBreak;
                modalStartTime.addEventListener('click', function() {
                    $('#modalTime').modal({
                        backdrop: false
                    });
                })
                break;
            case 'comida':
                bodyBreak.children[0].children[0].src = srcActiveBreak;
                let textHeaderBreakComida =`  <p class="text-uppercase c-header font-size-16 font-weight-900 m-0">tiempo para comida | 30 min</p>
                                        <p class="c-header font-size-14 m-0">
                                            Recuerda que el tiempo que no utilices será considerado en el tiempo de tu jornada laboral.
                                        </p>
                                        <p id="timer" class="font-size-70 c-yellow text-center time-container font-weight-900">00:00</p>
                                     `;
                bodyBreak.children[1].innerHTML = textHeaderBreakComida;
                modalStartTime.addEventListener('click', function() {
                    $('#modalTime').modal({
                        backdrop: false
                    });
                })
                break;
            case 'restroom':
                bodyBreak.children[0].children[0].src = srcActiveBreak;
                let textHeaderBreakRest =`  <p class="text-uppercase c-header font-size-16 font-weight-900 m-0">tiempo para ir al sanitario | 5 min</p>
                                        <p class="c-header font-size-14 m-0">
                                            Recuerda que el tiempo que no utilices será considerado en el tiempo de tu jornada laboral.
                                        </p>
                                        <p id="timer" class="font-size-70 c-yellow text-center time-container font-weight-900">00:00</p>
                                     `;
                bodyBreak.children[1].innerHTML = textHeaderBreakRest;
                modalStartTime.addEventListener('click', function() {
                    $('#modalTime').modal({
                        backdrop: false
                    });
                })
                break;
            case 'descanso':
                bodyBreak.children[0].children[0].src = srcActiveBreak;
                let textHeaderBreakB =`  <p class="text-uppercase c-header font-size-16 font-weight-900 m-0">tiempo para break | 10 min</p>
                                        <p class="c-header font-size-14 m-0">
                                            Recuerda que el tiempo que no utilices será considerado en el tiempo de tu jornada laboral.
                                        </p>
                                        <p id="timer" class="font-size-70 c-yellow text-center time-container font-weight-900">00:00</p>
                                     `;
                bodyBreak.children[1].innerHTML = textHeaderBreakB;
                modalStartTime.addEventListener('click', function() {
                    $('#modalTime').modal({
                        backdrop: false
                    });
                })
                break;
            case 'capacitacion':
                bodyBreak.children[0].children[0].src = srcActiveBreak;
                let textHeaderBreakCap =`  <p class="text-uppercase c-header font-size-16 font-weight-900 m-0">tiempo para capacitación | 10 min</p>
                                        <p class="c-header font-size-14 m-0">
                                            Recuerda que el tiempo que no utilices será considerado en el tiempo de tu jornada laboral.
                                        </p>
                                        <p id="timer" class="font-size-70 c-yellow text-center time-container font-weight-900">00:00</p>
                                     `;
                bodyBreak.children[1].innerHTML = textHeaderBreakCap;
                modalStartTime.addEventListener('click', function() {
                    $('#modalTime').modal({
                        backdrop: false
                    });
                })
                break;
            default:
                break;
        }
    });
});

if(typeof(recordButton) != 'undefined' && recordButton != null){
  recordButton.addEventListener('click', function() {
      $('#recording').modal({
          backdrop: false
      });
  });
}

var timer = document.getElementById("timer");
var start = document.getElementById("start");
var pause = document.getElementById("pause");
var resume = document.getElementById("resume");
var id;
var value = "00:00";

function startTimer(m, s) {
    timer.textContent = m + ":" + s;
    if (s == 0) {
        if (m == 0) {
            return;
        } else if (m != 0) {
            m = m - 1;
            s = 60;
        }
    }
    s = s - 1;
    id = setTimeout(function () {
        startTimer(m, s)
    }, 1000);
}

function pauseTimer() {
    resume.classList.remove('d-hide');
    pause.classList.add('d-hide');
    value = timer.textContent;
    clearTimeout(id);
}

function resumeTimer() {
    resume.classList.add('d-hide');
    pause.classList.remove('d-hide');
    var t = value.split(":");
    startTimer(parseInt(t[0], 10), parseInt(t[1], 10));
}

pause.addEventListener("click", pauseTimer, false);
resume.addEventListener("click", resumeTimer, false);
