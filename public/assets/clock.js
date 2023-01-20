// $(document).ready(function () {
//     $('#hidden_div').on('click', function() {
//         $('#hidden_div').html('수정 눌러서 보여짐');
//         console.log('클릭');
//     })
// });

let clock = document.getElementById('clock');

function getTime(){
    const time = new Date();
    const hours = time.getHours();
    const minutes = time.getMinutes();
    const seconds = time.getSeconds();
    clock.innerText = `${hours < 10 ? `0${hours}` : hours}:${minutes < 10 ? `0${minutes}` : minutes}:${seconds < 10 ? `0${seconds}` : seconds}`;
}

function init() {
    setInterval(getTime, 1000);
}

getTime();
init();