let html = document.getElementById("tiempo");

function actualizarReloj() {
    const tiempo = new Date();
    let horas = tiempo.getHours();
    let minutos = tiempo.getMinutes();
    let segundos = tiempo.getSeconds();

    if(horas<10)
        horas = "0"+horas;
    if(minutos<10)
        minutos = "0"+minutos;
    if(segundos<10)
        segundos = "0"+segundos;

    html.innerHTML = horas+" : "+minutos+" : "+segundos;
}

setInterval(actualizarReloj, 1000);