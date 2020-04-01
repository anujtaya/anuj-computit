@extends('layouts.service_seeker_master')
@section('content')

{{-- The style tag css is not loading up in the page. --}}

<style>

  body {
  font-family: sans-serif;
  display: grid;
  height: 100vh;
  place-items: center;
  }

  .base-timer {
  position: relative;
  width: 300px;
  height: 300px;
  }

  .base-timer__svg {
  transform: scaleX(-1);
  }

  .base-timer__circle {
  fill: none;
  stroke: none;
  }

  .base-timer__path-elapsed {
  stroke-width: 7px;
  stroke: grey;
  }

  .base-timer__path-remaining {
  stroke-width: 7px;
  stroke-linecap: round;
  transform: rotate(90deg);
  transform-origin: center;
  transition: 1s linear all;
  fill-rule: nonzero;
  stroke: currentColor;
  }

  .base-timer__path-remaining.green {
  color: rgb(65, 184, 131);
  }

  .base-timer__path-remaining.orange {
  color: orange;
  }

  .base-timer__path-remaining.red {
  color: red;
  }

  .base-timer__label {
  position: absolute;
  width: 300px;
  height: 300px;
  top: 0;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 48px;
  }
</style>

<div class="container">
   <div class="row  justify-content-center" >
      <div class="col-lg-12 shadow-sm sticky-top bg-white p-3 border-d">
         <div class="row">
            <div class="col-4">    <i class="fas fa-theater-masks theme-color m-1 fs-1"></i> </div>
            <div class="col-4 font-size-bolder text-center font-weight-bold theme-color">Timer <br><span class="fs--2 text-muted font-weight-normal"></span></div>
         </div>
      </div>
      <div class="col-lg-12  bg-white pl-2 pr-2 mt-2  border-d">
        <div id="app"></div>
      </div>
   </div>
</div>
@include('service_seeker.bottom_navigation_bar')


<script>

// Credit: Mateusz Rybczonec

const FULL_DASH_ARRAY = 283;
const WARNING_THRESHOLD = 10;
const ALERT_THRESHOLD = 5;

const COLOR_CODES = {
info: {
  color: "green"
},
warning: {
  color: "orange",
  threshold: WARNING_THRESHOLD
},
alert: {
  color: "red",
  threshold: ALERT_THRESHOLD
}
};

const TIME_LIMIT = 40;
let timePassed = 0;
let timeLeft = TIME_LIMIT;
let timerInterval = null;
let remainingPathColor = COLOR_CODES.info.color;

document.getElementById("app").innerHTML = `
<div class="base-timer">
<svg class="base-timer__svg" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
  <g class="base-timer__circle">
    <circle class="base-timer__path-elapsed" cx="50" cy="50" r="45"></circle>
    <path
      id="base-timer-path-remaining"
      stroke-dasharray="283"
      class="base-timer__path-remaining ${remainingPathColor}"
      d="
        M 50, 50
        m -45, 0
        a 45,45 0 1,0 90,0
        a 45,45 0 1,0 -90,0
      "
    ></path>
  </g>
</svg>
<span id="base-timer-label" class="base-timer__label">${formatTime(
  timeLeft
)}</span>
</div>
`;

startTimer();

function onTimesUp() {
clearInterval(timerInterval);
}

function startTimer() {
timerInterval = setInterval(() => {
  timePassed = timePassed += 1;
  timeLeft = TIME_LIMIT - timePassed;
  document.getElementById("base-timer-label").innerHTML = formatTime(
    timeLeft
  );
  setCircleDasharray();
  setRemainingPathColor(timeLeft);

  if (timeLeft === 0) {
    onTimesUp();
  }
}, 1000);
}

function formatTime(time) {
const minutes = Math.floor(time / 60);
let seconds = time % 60;

if (seconds < 10) {
  seconds = `0${seconds}`;
}

return `${minutes}:${seconds}`;
}

function setRemainingPathColor(timeLeft) {
const { alert, warning, info } = COLOR_CODES;
if (timeLeft <= alert.threshold) {
  document
    .getElementById("base-timer-path-remaining")
    .classList.remove(warning.color);
  document
    .getElementById("base-timer-path-remaining")
    .classList.add(alert.color);
} else if (timeLeft <= warning.threshold) {
  document
    .getElementById("base-timer-path-remaining")
    .classList.remove(info.color);
  document
    .getElementById("base-timer-path-remaining")
    .classList.add(warning.color);
}
}

function calculateTimeFraction() {
const rawTimeFraction = timeLeft / TIME_LIMIT;
return rawTimeFraction - (1 / TIME_LIMIT) * (1 - rawTimeFraction);
}

function setCircleDasharray() {
const circleDasharray = `${(
  calculateTimeFraction() * FULL_DASH_ARRAY
).toFixed(0)} 283`;
document
  .getElementById("base-timer-path-remaining")
  .setAttribute("stroke-dasharray", circleDasharray);
}


</script>
@endsection
