/**
 * Created by BreynerJPB on 29/10/2016.
 */
/**
 * Created by BreynerJPB on 29/10/2016.
 */
/*
 * Session para las variables
 * */
var base_url = "http://127.0.0.1:8000/";
var eventos = {};
var cantidadEventos = 1;
var infomap, map;
var localizacion = [];
var geocoder;
var _token = "";
//Se cargar los complementos cuando la pagina este lista.
$(document).ready(function () {

    /*$('[data-toggle="tooltip"]').tooltip();*/

    //Mostramos la imagen de cargando.
    $("#div_cargandoevento").show();
    //FUncion que muestra y oculta el menu.
    /*$("#menu-toggle").click(function (e) {
     e.preventDefault();
     $("#wrapper").toggleClass("toggled");
     });*/
    //Funcion que carga los eventos.
    eventos.cargar();


});

//Muestra la fecha en string.
eventos.mostrarfechastring = function (fecha) {
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

    return nombres_dias[dia_semana] + ", " + dia_mes + " de " + nombres_meses[mes - 1] + " de " + anio + " " + horas + ":" + minutos;
}

//Funcion que carga los div con las respectivas informaciones.
eventos.CargarDiv = function (data) {
    //Varible a la cual se agregan los eventos cargados desde BD.
    var items = [];
    if (data != undefined && data != null && data.length > 0) {
        cantidadEventos = data.length;
        //Se restablece el mapa.
        RestablecerMapa();
        $.each(data, function (key, val) {
            items.push(
                '<div  class="thumbnail right-caption span4 div_eventosgeneral">'
                + '<div id="div_eventos' + val.eventid + '" name="div_eventos" class="caption">'
                + '<img style="width: 150px;height: 100px;" class="img-event lazy img-thumbnail img_eventosbuscar col-md-3 p_tipoevento img-responsive" src="' + val.imagen + '" alt="">'
                + '<div class="pull-right">' + val.categoria + '</div>'
                + '<br>'
                + '<div class="cortartexto">'
                + '<p><span id="icono" class="glyphicon glyphicon-calendar li_subcategoriaprincipal" style="font-weight: normal"></span><small><span>' + eventos.mostrarfechastring(val.fecha) + '</span></small></p>'
                + '<a href="#"><h4 class="cortartexto"><span id="icono" class="glyphicon glyphicon-star li_subcategoriaprincipal" style="font-weight: normal"></span>' + val.nombre + '</h4></a>'
                + '<div id="div_descripcionevento">'
                + '<p><span id="icono" class="glyphicon glyphicon-map-marker li_subcategoriaprincipal" style="font-weight: normal"></span><span class="cortartexto">' + val.direccion + '</span></p>'
                + '</div >'
                + '</div>'
                + '<div class="row">'
                + '<div class="col-xs-12">'
                + '<hr style="margin: 0;margin-bottom:1px; margin-top:10px;">'
                + '<div class="pull-right">'
                + '<div class="btn-group">'
                + '<button type="button" class="btn btn-info" data-toggle="tooltip" title="Compartir en facebook" ><span class="glyphicon glyphicon-share "></span></button>'
                + '<button type="button" class="btn btn-success" title="Agendar Evento" data-toggle="tooltip"><span class="glyphicon glyphicon-calendar"></span></button>'
                + '</div>'
                + '</div>'
                + '<div class="pull-center ">'
                + '<p class="pull-left col-md-2 pull-center" >' + val.tipo + '</p>'
                + '</div>'
                + '</div>'
                + '</div>'
                + '</div>'
                + '</div>');
            //Funcion que busca los eventos por direccion.
            LocalizarEventoDireccion(val.direccion + ", " + val.municipio + "-" + val.departamento + ", Colombia", val.nombre, val.imagen);
        });

    } else {
        items.push("<div class='toastr.error toastr.error-info text-center'><span>No hay eventos para mostrar!</span></div>");
        toastr.info("No hay eventos para mostrar!");
    }
    $("#div_eventos").html("");
    $("#div_eventos").append(items);
    //Ocultamos la imagen de cargando.
    $("#div_cargandoevento").hide();
    $("#NombreCiudad").html("Eventos en Cartagena");
}
eventos.cargar = function () {
    try {
        $.getJSON(base_url + "/cargareventos", function (data) {
            //Mostramos la imagen de cargando.
            $("#div_cargandoevento").show();
            var dato = JSON.parse(data);
            eventos.CargarDiv(dato);
            $("#div_cargandoevento").hide();
        }).fail(function (error) {
            toastr.error("Error eventos.cargar::.." + error.responseText);
        });
    } catch (ex) {
        toastr.error("Error eventos.cargar::.." + ex);
    }
}

/*var cssObj = {
 'box-shadow': '#888 3px 5px 5px', // Added when CSS3 is standard
 '-webkit-box-shadow': '#888 3px 5px 5px', // Safari
 '-moz-box-shadow': '#888 3px 5px 5px'
 }; // Firefox 3.5+
 $("#div_resultadosbusquedaeventos").css(cssObj);*/

// Fade out the suggestions box when not active
$("input").blur(function () {
    $('#div_resultadosbusquedaeventos').fadeOut();
});


function buscareventos(inputString, token) {
    if (inputString.length == 0) {
        $('#div_resultadosbusquedaeventos').fadeOut(); // Hide the suggestions box
    } else {
        try {
            $.post(base_url + "buscareventos", {
                "busquedaeventos": inputString,
                "opcion": "filtroeventos",
                "_token": token
            }, function (dato) { // Do an AJAX call
                var data = JSON.parse(dato);
                var eventos = [];
                //Muestra el cargando en el buscador.
                $("#div_cargandoeventobuscar").show();
                eventos.push('<ul id="searchresults" style="width: 100%;" role="listbox">');
                if (data != "" && data != undefined && data != null) {
                    $.each(data, function (key, val) {
                        eventos.push(
                            '<li style="font-size: 12px;list-style: none;">'
                            + '<a href="" class="col-lg-12 a_eventoprincipal">'
                            + '<img class="lazy img-responsive img-event col-xs-2 img_eventosbuscar" alt="" src="' + val.imagen + '"/>'
                            + '<div class="col-xs-10 div_eventosdescripcion">'
                            + '<span class="span_text li_principal">' + val.nombre + '</span>'
                            + '<span class="span_text" style="color: blue">' + val.municipio + ", " + val.departamento + '</span>'
                            + '<span style="font-size: 8px" class="span_text li_principal">' + val.direccion + '</span>'
                            + '</div>'
                            + '</a>'
                            + '</li>'
                        );
                    });
                } else {
                    eventos.push("<div class='toastr.error toastr.error-info text-center col-lg-12'>No hay eventos para mostrar!</div>");
                }
                eventos.push('</ul>');
                $('#div_resultadosbusquedaeventos').fadeIn(); // Show the suggestions box
                $('#div_resultadosbusquedaeventos').html("");
                $('#div_resultadosbusquedaeventos').append(eventos); // Fill the suggestions box
                //Oculta el cargando en el buscador.
                $("#div_cargandoeventobuscar").hide();
            }).fail(function (error) {
                toastr.error("Error buscareventos::.." + error.responseText);
            });
        } catch (ex) {
            toastr.error("Error buscareventos::.." + ex);
        }
    }
}

//Buscar los eventos por gratis, pagos,populares,fechas.
function buscareventostipos(opcion, token) {
    try {
        $.post(base_url + "buscareventos", {
            "busquedaeventos": opcion,
            "opcion": "filtroeventostipos",
            "_token": token
        }, function (data) {
            //Mostramos la imagen de cargando.
            $("#div_cargandoevento").show();
            var dato = JSON.parse(data);
            eventos.CargarDiv(dato);
            $("#div_cargandoevento").hide();
        }).fail(function (error) {
            toastr.error("Error buscareventostipos::.." + error.responseText);
        });
    } catch (ex) {
        toastr.error("Error buscareventostipos::.." + ex);
    }
}

// Note: This example requires that you consent to location sharing when
// prompted by your browser. If you see the error "The Geolocation service
// failed.", it means you probably did not give permission for the browser to
// locate you.

function initMap() {
    try {
        geocoder = new google.maps.Geocoder();
        map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: 10.3997200, lng: -75.5144400},
            zoom: 12,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });
        var infoWindow = new google.maps.InfoWindow({map: map});

        // Try HTML5 geolocation.
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                var pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };

                infoWindow.setPosition(pos);
                infoWindow.setContent('<a href="#">Migoos te hubica.</a>');
                map.setCenter(pos);
            }, function () {
                handleLocationError(true, infoWindow, map.getCenter());
            });
        } else {
            // Browser doesn't support Geolocation
            handleLocationError(false, infoWindow, map.getCenter());
        }
    } catch (ex) {
        toastr.error("Error initMap::.." + ex);
    }
}

function handleLocationError(browserHasGeolocation, infoWindow, pos) {
    infoWindow.setPosition(pos);
    infoWindow.setContent(browserHasGeolocation ?
        'Error handleLocationError: No se pudo obtener los datos de tu ubicación.' :
        'Error handleLocationError: El navegador no soporta Geolocation.');
}

//Funcion que se utiliza para mostrar y ocultar el menu de los filtros
function MostrarOcultar(etiqueta, etiqueta1) {
    var eti = $(etiqueta).find("#imagenmostrar");
    if ($(eti).hasClass("mostrar")) {
        $("#" + etiqueta1).fadeIn();
        $(eti).removeClass("glyphicon-chevron-down");
        $(eti).addClass("glyphicon-chevron-up");
        $(eti).removeClass("mostrar");
        $(eti).addClass("ocultar");
    } else {
        $("#" + etiqueta1).fadeOut();
        $(eti).addClass("glyphicon-chevron-down");
        $(eti).removeClass("glyphicon-chevron-up");
        $(eti).addClass("mostrar");
        $(eti).removeClass("ocultar");
    }
}
//Muestra y coulta la fecha personalizada.
function MostrarOcultarFecha(etiqueta, etiqueta1) {
    var eti = $(etiqueta).find("#imagenmostrar");
    if ($(eti).hasClass("mostrar")) {
        $("#" + etiqueta1).fadeIn();
        $(eti).removeClass("glyphicon-chevron-down");
        $(eti).addClass("glyphicon-chevron-up");
        $(eti).removeClass("mostrar");
        $(eti).addClass("ocultar");
    } else {
        $("#" + etiqueta1).fadeOut();
        $(eti).addClass("glyphicon-chevron-down");
        $(eti).removeClass("glyphicon-chevron-up");
        $(eti).addClass("mostrar");
        $(eti).removeClass("ocultar");
    }
}
var datos = [];
function BuscarPorCiudades(parametro) {
    /*$.post(base_url + 'HomeCtrol/buscareventosciudad', {busquedaeventosciudad: parametro},
     function (data) {
     datos = data;
     }
     ).fail(function (Error) {
     toastr.error("Error::.." + Error);
     });*/
}

//Funcion que carga complementos.
function CargarComplementos(token) {
    //Funcion para retrazar la carga de las imagenes.
    $("img.lazy").lazyload({
        event: "sporty",
        effect: "fadeIn"
    });

    $(function () {
        $("#input_buscarporciudades").autocomplete({
            source: function (request, response) {
                try {
                    $.post(base_url + 'buscareventosciudad', {"busquedaeventosciudad": request.term, "_token": token},
                        function (data) {
                            var datos = null;
                            if (data != "" && data != undefined) {
                                datos = JSON.parse(data);
                                response($.map(datos, function (item) {
                                    return {
                                        label: item.label,
                                        value: item.label,
                                        id: item.id
                                    }
                                }));
                            } else {
                                response(datos = []);
                            }
                        }
                    ).fail(function (Error) {
                        toastr.error("Error CargarComplementos::.." + Error.responseText);
                    });
                } catch (ex) {
                    toastr.error("Error CargarComplementos::.." + ex);
                }
            },
            autoFocus: true,
            minLength: 0,
            select: function (event, ui) {
                buscarfiltrociudades(ui.item.id);
                $("#NombreCiudad").html("Eventos en la ciudad de " + ui.item.label);
                /*log(ui.item ?
                 "Selected: " + ui.item.label :
                 "Nothing selected, input was " + this.value);*/
            }
        });
    });
    $(function () {
        $('#fechadesde').datetimepicker({
            format: 'YYYY/MM/DD',
            locale: 'es'
        });
        $('#fechahasta').datetimepicker({
            format: 'YYYY/MM/DD',
            locale: 'es'
        });
    });
}

//Funcion ajax que trae los eventos de la ciudad que se selecciona en el filtro.
function buscarfiltrociudades(parametro) {
    try {
        $.post(base_url + 'buscarfiltrociudades', {"buscarfiltrociudades": parametro, "_token": _token},
            function (dato) {
                var data = JSON.parse(dato);
                eventos.CargarDiv(data);
            }
        ).fail(function (Error) {
            toastr.error("Error buscarfiltrociudades::.." + Error.responseText);
        });
    } catch (ex) {
        toastr.error("Error buscarfiltrociudades::.." + ex);
    }
}

//Vacia el filtro de ciudades.
function vaciarfiltro(etiqueta) {
    $(etiqueta).val("");
}

//funcion que busca los eventos por las opciones de busquedas despegables.
function opcionesbusqueda(opcionbusqueda, busqueda) {
    try {
        $.post(base_url + 'buscaropcionbusqueda', {"opcionbusqueda": opcionbusqueda, "busqueda": busqueda,"_token":_token},
            function (dato) {
                $("#NombreCiudad").html("Eventos de " + busqueda + "-" + "Cartagena");
                $(".divcargandogeneral").show();
                var data=JSON.parse(dato);
                eventos.CargarDiv(data);
                $(".divcargandogeneral").hide();
            }
        ).fail(function (Error) {
            toastr.error("Error opcionesbusqueda::.." + Error.responseText);
        });
    } catch (ex) {
        toastr.error("Error opciones busqueda::.." + ex);
    }
}

//Funcion que hubica las direcciones de los eventos en google maps.
function LocalizarEvento() {
    try {
        //Creates a map object.
        map = document.getElementById("map");
        map = new google.maps.Map(map);
        map.setMapTypeId(google.maps.MapTypeId.ROADMAP);

        //Creates a infowindow object.
        infomap = new google.maps.InfoWindow();

        //Mapping markers on the map
        var bounds = new google.maps.LatLngBounds();
        var station, i, latlng;
        for (i in localizacion) {
            //Creates a marker
            station = localizacion[i];
            latlng = new google.maps.LatLng(station.latitud, station.longitud);
            bounds.extend(latlng);
            var marker = createMarker(
                map, latlng, station.nombre, station.imagen
            );

            //Creates a sidebar button for the marker
            //createMarkerButton(marker);
        }
        //Fits the map bounds
        map.fitBounds(bounds);
    } catch (ex) {
        toastr.error("Error initMap::.." + ex);
    }
}

function createMarker(map, latlng, title, imagen) {
    //Creates a marker
    var marker = new google.maps.Marker({
        position: latlng,
        map: map,
        title: title
    });

    var html = "<div >" +
        "<img class='img_eventosbuscar infoeventoimg pull-left col-xs-3' style='width: 72px;height: 36px;' src='" + imagen + "' alt='" + title + "'>" +
        "<div style='max-width: 120px;width: 120px;display: table-cell;vertical-align: middle;'>" +
        " <h4 class='inforevento'>" + title + "</h4>" +
        "</div>"
    "</div>";

    google.maps.event.addListener(marker, 'mouseover', function () {
        infomap.setContent(html);
        infomap.open(map, marker);

    });
    /* google.maps.event.addListener(marker, 'mouseout', function () {
     infomap.close();
     });*/
    return marker;
}

//Restablecer mapa.
function RestablecerMapa() {
    localizacion = [];
}

//Funcion que carga la latitud y longitud del evento por medio de la direccion.
function LocalizarEventoDireccion(direccion, nombre, imagen) {
    var di = direccion;
    try {
        geocoder.geocode({'address': di}, function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                /*mapa.setCenter(results[0].geometry.location);
                 creaMarcador(results[0].geometry.location);*/
                localizacion.push({
                    nombre: nombre,
                    imagen: imagen,
                    latitud: results[0].geometry.location.lat(),
                    longitud: results[0].geometry.location.lng()
                });
                if (localizacion.length >= cantidadEventos) {
                    LocalizarEvento();
                }
            }
            else {
                cantidadEventos - 1;
            }
        });
    } catch (ex) {
        toastr.error("Error LocalizarEventoDireccion::.." + ex);
    }
}

//funcion que busca los eventos por fechas.
function buscareventosfecha() {
    try {
        var desde = $("#fechadesde").val(), hasta = $("#fechahasta").val();
        if (desde != "" && desde != undefined) {
            if (hasta != "" && hasta != undefined) {
                $.post(base_url + 'HomeCtrol/buscareventosfecha', {"desde": desde, "hasta": hasta},
                    function (data) {
                        $("#NombreCiudad").html("Eventos desde,hasta en Cartagena");
                        $(".divcargandogeneral").show();
                        eventos.CargarDiv(data);
                        $(".divcargandogeneral").hide();
                    }
                ).fail(function (Error) {
                    toastr.error("Error opcionesbusqueda::.." + Error.responseText);
                });
            } else {
                toastr.info("Debe seleccionar una fecha hasta!");
            }
        } else {
            toastr.info("Debe seleccionar una fecha desde!");
        }
    } catch (ex) {
        toastr.error("Error opciones busqueda::.." + ex);
    }
}
