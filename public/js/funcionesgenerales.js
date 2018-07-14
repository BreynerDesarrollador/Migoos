function fechastring(fecha) {
    ms = Date.parse(fecha);
    //fecha = new Date(ms);
    var nombres_dias = new Array("Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado")
    var nombres_meses = new Array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre")
    var fecha_actual = new Date(ms);

    dia_mes = fecha_actual.getDate() //dia del mes
    dia_semana = fecha_actual.getDay() //dia de la semana
    mes = fecha_actual.getMonth() + 1
    anio = fecha_actual.getFullYear();

    var horas = fecha_actual.getHours();
    var minutos = fecha_actual.getMinutes();
    var segundos = fecha_actual.getSeconds();
    var sufijo = 'AM';

    /*if (horas > 12) {
     horas = horas - 12;
     sufijo = 'PM';
     }

     if (horas < 10) {
     horas = '0' + horas;
     }
     if (minutos < 10) {
     minutos = '0' + minutos;
     }
     if (segundos < 10) {
     segundos = '0' + segundos;
     }*/

//escribe en pagina

    return {'nombre_dia':nombres_dias[dia_semana],'dia_mes':dia_mes,'nombre_mes':nombres_meses[mes - 1],'ano':anio,'horas':horas,'minutos':minutos};//nombres_dias[dia_semana] + ", " + dia_mes + " de " + nombres_meses[mes - 1] + " de " + anio + " " + horas + ":" + minutos;
}
function convertirmoneda(amount,decimals){
    amount += ''; // por si pasan un numero en vez de un string
    amount = parseFloat(amount.replace(/[^0-9\.]/g, '')); // elimino cualquier cosa que no sea numero o punto
    decimals = decimals || 0; // por si la variable no fue fue pasada

    // si no es un numero o es igual a cero retorno el mismo cero
    if (isNaN(amount) || amount === 0)
        return parseFloat(0).toFixed(decimals);

    // si es mayor o menor que cero retorno el valor formateado como numero
    amount = '' + amount.toFixed(decimals);

    var amount_parts = amount.split('.'),
        regexp = /(\d+)(\d{3})/;

    while (regexp.test(amount_parts[0]))
        amount_parts[0] = amount_parts[0].replace(regexp, '$1' + ',' + '$2');

    return amount_parts.join('.');
}