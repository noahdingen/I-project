var deadline = '';


function setDeadline(time){
	deadline = time;
}

function getTimeRemaining(endtime){
  var t = endtime - new Date();
  var seconds = Math.floor( (t/1000) % 60 );
  var minutes = Math.floor( (t/1000/60) % 60 );
  var hours = Math.floor( (t/(1000*60*60)) % 24 );
  var days = Math.floor( t/(1000*60*60*24) );
  return {
    'total': t,
    'days': days,
    'hours': hours,
    'minutes': minutes,
    'seconds': seconds
  };
}

function initializeClock(id, endtime){
  var clock = document.getElementById(id);
  var timeinterval = setInterval(function(){
    var t = getTimeRemaining(endtime);
    clock.innerHTML = 'De veiling sluit over: ' + ('0' + t.days).slice(-2) + ' : ' +
                      ('0' + t.hours).slice(-2)  + ' : ' +
                      ('0' + t.minutes).slice(-2) + ' : ' +
                      ('0' + t.seconds).slice(-2);
    if(t.total<=0){
		clock.innerHTML = 'DE VEILING IS GESLOTEN!';
      clearInterval(timeinterval);
    }
  },1000);
}

