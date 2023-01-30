let xmlhttp;
document.getElementById("ajax_btn_post").addEventListener('click', makeRequestPost);
document.getElementById("ajax_btn_get").addEventListener('click', makeRequestGet);
let token = document.querySelector('meta[name="csrf-token"]').content;

function makeRequestGet(){
    xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = Callback;

    xmlhttp.open('GET', "http://localhost/ajaxget", true);

    xmlhttp.setRequestHeader('X-CSRF-TOKEN', token);
    xmlhttp.setRequestHeader('Content-Type', 'application/json');

    xmlhttp.send(null);
}

function makeRequestPost(){
    xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = Callback;

    xmlhttp.open('POST', "http://localhost/ajaxpost", true);

    let data = {'test': 'ajax test'};
    xmlhttp.setRequestHeader('X-CSRF-TOKEN', token);
    xmlhttp.setRequestHeader('Content-Type', 'application/json');

    xmlhttp.send(JSON.stringify(data));
}

function Callback () {
    console.log(xmlhttp.responseText);
    document.getElementById("ajax_test").innerText = xmlhttp.responseText;
}