@extends('layouts.app')
@section('content')
    <!--<input type="hidden" id="_toke" name="_toke" value="{{csrf_field()}}"/>-->
    <div class="container">
        <div class="row">
            <div class="col-xs-4  col-lg-4 col-md-4 col-sm-12">
                <div class="col-xs-12">
                    <div class="panel panel-default ">
                        <div class="panel-heading">
                            <h3 class="panel-title">Donde te encuentras</h3>
                        </div>
                        <div class="panel-body text-left">
                            <div style="height: 250px;width: 100%;" name="map" id="map"></div>
                        </div>
                        <div class="panel-footer">Tú ubicación real</div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-12">
                    <div class="panel panel-default hidden-xs">
                        <div class="panel-heading text-center">
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1"><span style="color: black"
                                                                                        class="glyphicon glyphicon-map-marker"></span></span>
                                <input type="text" id="input_buscarporciudades" onclick="vaciarfiltro(this);"
                                       autocomplete="off" name="input_buscarporciudades" class="form-control"
                                       placeholder="Ciudad o Ubicación" aria-describedby="basic-addon1">
                            </div>
                        </div>
                        <div id="filtros" class="panel-body hidden-xs" style="color: #0278b8;">
                            <hr class="col-xs-10 col-sm-12">
                            <div style="cursor: pointer" id="div_categorias" class="filtro_grupo"
                            >
                                <div onclick="MostrarOcultar(this,'ul_categorias');">
                                    <span class="pull-left">CATEGORÍAS</span> <span
                                            class="glyphicon glyphicon-chevron-down filtro_grupo pull-right mostrar"
                                            id="imagenmostrar"></span>
                                </div>
                                <ul id="ul_categorias"
                                    class="text-left col-xs-12 ul_filtros">
                                    <br>
                                    <li class="li_subcategoria li_subcategoriaprincipal">Todas las categorias</li>
                                    <br>
                                    <li onclick="opcionesbusqueda('CATEGORIA', 'Negocios')" class="li_subcategoria">
                                        Negocios
                                    </li>
                                    <li onclick="opcionesbusqueda('CATEGORIA', 'Ciencia y tecnologia')"
                                        class="li_subcategoria">Ciencia y tecnología
                                    </li>
                                    <li onclick="opcionesbusqueda('CATEGORIA', 'Arte')" class="li_subcategoria">Artes
                                    </li>
                                    <li onclick="opcionesbusqueda('CATEGORIA', 'Familia y educacion')"
                                        class="li_subcategoria">Familia y educación
                                    </li>
                                    <li onclick="opcionesbusqueda('CATEGORIA', 'Espiritualidad')"
                                        class="li_subcategoria">Espiritualidad
                                    </li>
                                    <li onclick="opcionesbusqueda('CATEGORIA', 'Comunidad')" class="li_subcategoria">
                                        Comunidad
                                    </li>
                                    <li onclick="opcionesbusqueda('CATEGORIA', 'Deportes y salud')"
                                        class="li_subcategoria">Deportes y salud
                                    </li>
                                    <li onclick="opcionesbusqueda('CATEGORIA', 'Organizaciones y causas beneficas')"
                                        class="li_subcategoria">Organizaciones y causas benéficas
                                    </li>
                                    <li onclick="opcionesbusqueda('CATEGORIA', 'Musica')" class="li_subcategoria">
                                        Música
                                    </li>
                                    <li onclick="opcionesbusqueda('CATEGORIA', 'Cine y medios de comunicacion')"
                                        class="li_subcategoria">Cine y medios de comunicación
                                    </li>
                                    <li onclick="opcionesbusqueda('CATEGORIA', 'Salud')" class="li_subcategoria">Salud
                                    </li>
                                    <li onclick="opcionesbusqueda('CATEGORIA', 'Bobierno')" class="li_subcategoria">
                                        Gobierno
                                    </li>
                                    <li onclick="opcionesbusqueda('CATEGORIA', 'Coches, barcos y aviones')"
                                        class="li_subcategoria">Coches, barcos y aviones
                                    </li>
                                    <li onclick="opcionesbusqueda('CATEGORIA', 'Aficiones')" class="li_subcategoria">
                                        Aficiones
                                    </li>
                                    <li onclick="opcionesbusqueda('CATEGORIA', 'Otros')" class="li_subcategoria">Otros
                                    </li>
                                </ul>
                            </div>
                            <hr class="col-xs-10 col-sm-12">
                            <div style="cursor: pointer" id="div_tipo_evento" class="filtro_grupo"
                            >
                                <div onclick="MostrarOcultar(this,'ul_tipoevento');">
                                    <span class="pull-left">TIPOS DE EVENTOS</span><span
                                            class="glyphicon glyphicon-chevron-down filtro_grupo pull-right mostrar"
                                            id="imagenmostrar"></span>
                                </div>
                                <ul id="ul_tipoevento" class="text-left col-xs-12 ul_filtros">
                                    <br>
                                    <li class="li_subcategoria li_subcategoriaprincipal">Todos los tipos de eventos</li>
                                    <br>
                                    <li onclick="opcionesbusqueda('TIPODEEVENTO', 'Cursos')" class="li_subcategoria">
                                        Cursos
                                    </li>
                                    <li onclick="opcionesbusqueda('TIPODEEVENTO', 'Seminarios')"
                                        class="li_subcategoria">Seminario
                                    </li>
                                    <li onclick="opcionesbusqueda('TIPODEEVENTO', 'Conferencias')"
                                        class="li_subcategoria">Conferencia
                                    </li>
                                    <li onclick="opcionesbusqueda('TIPODEEVENTO', 'Festival')" class="li_subcategoria">
                                        Festival
                                    </li>
                                    <li onclick="opcionesbusqueda('TIPODEEVENTO', 'Generacion de contactos')"
                                        class="li_subcategoria">Generación de contactos
                                    </li>
                                    <li onclick="opcionesbusqueda('TIPODEEVENTO', 'Convencion')"
                                        class="li_subcategoria">Convención
                                    </li>
                                    <li onclick="opcionesbusqueda('TIPODEEVENTO', 'Actuacion')" class="li_subcategoria">
                                        Actuación
                                    </li>
                                    <li onclick="opcionesbusqueda('TIPODEEVENTO', 'Proyeccion')"
                                        class="li_subcategoria">Proyección
                                    </li>
                                    <li onclick="opcionesbusqueda('TIPODEEVENTO', 'Fiesta')" class="li_subcategoria">
                                        Fiesta
                                    </li>
                                    <li onclick="opcionesbusqueda('TIPODEEVENTO', 'Torneo')" class="li_subcategoria">
                                        Torneo
                                    </li>
                                    <li onclick="opcionesbusqueda('TIPODEEVENTO', 'Juego')" class="li_subcategoria">
                                        Juego
                                    </li>
                                    <li onclick="opcionesbusqueda('TIPODEEVENTO', 'Carrera')" class="li_subcategoria">
                                        Carrera
                                    </li>
                                    <li onclick="opcionesbusqueda('TIPODEEVENTO', 'Atraccion')" class="li_subcategoria">
                                        Atracción
                                    </li>
                                    <li onclick="opcionesbusqueda('TIPODEEVENTO', 'Otros')" class="li_subcategoria">
                                        Otros
                                    </li>
                                </ul>

                            </div>
                            <hr class="col-xs-10 col-sm-12">
                            <div style="cursor: pointer" class="filtro_grupo"
                            >
                                <div onclick="MostrarOcultar(this,'ul_fechas');">
                                    <span class="pull-left">FECHAS</span><span
                                            class="glyphicon glyphicon-chevron-down filtro_grupo pull-right mostrar"
                                            id="imagenmostrar"></span>
                                </div>
                                <ul id="ul_fechas" class="text-left col-xs-12 ul_filtros">
                                    <br>
                                    <li class="li_subcategoria li_subcategoriaprincipal">Todas las fechas</li>
                                    <br>
                                    <li onclick="opcionesbusqueda('FECHA', 'Hoy')" class="li_subcategoria">Hoy</li>
                                    <li onclick="opcionesbusqueda('FECHA', 'Mañana')" class="li_subcategoria">Mañana
                                    </li>
                                    <li onclick="opcionesbusqueda('FECHA', 'Esta_semana')" class="li_subcategoria">Esta
                                        semana
                                    </li>
                                    <li onclick="opcionesbusqueda('FECHA', 'Este_fin_de_semana')"
                                        class="li_subcategoria">Este fin de semana
                                    </li>
                                    <li onclick="opcionesbusqueda('FECHA', 'La_proxima_semana')"
                                        class="li_subcategoria">La próxima semana
                                    </li>
                                    <li onclick="opcionesbusqueda('FECHA', 'Este_mes')" class="li_subcategoria">Este
                                        mes
                                    </li>
                                    <li class="li_subcategoria" id="li_fechaperpal"
                                        onclick="MostrarOcultarFecha(this,'li_fechapersonalizada')">Fecha
                                        personalizada<span
                                                class="glyphicon glyphicon-chevron-down filtro_grupo pull-right mostrar"
                                                id="imagenmostrar"></span></li>
                                    <li class="li_subcategoria" id="li_fechapersonalizada" style="display: none">
                                        <div class="form-group">
                                            <label class="col-xs-3 control-label" style="color: black">Desde:</label>
                                            <div class="col-xs-12">
                                                <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1"><span style="color: black"
                                                                                        class="glyphicon glyphicon-calendar"></span></span>
                                                    <input type="text" class="form-control" id="fechadesde"
                                                           name="fechadesde" placeholder="Fecha desde...">
                                                </div>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-xs-3 control-label" style="color: black">Hasta:</label>
                                            <div class="col-xs-12">
                                                <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1"><span style="color: black"
                                                                                        class="glyphicon glyphicon-calendar"></span></span>
                                                    <input type="text" class="form-control" id="fechahasta"
                                                           name="fechahasta" placeholder="Fecha hasta...">
                                                </div>

                                            </div>
                                        </div>
                                        <div class="form-group text-center">
                                            <span style="width: 90%;" class="btn btn-primary "
                                                  onclick="buscareventosfecha();"><span
                                                        class="glyphicon glyphicon-refresh"></span>Buscar</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <hr class="col-xs-10 col-sm-12">
                            <div style="cursor: pointer" class="filtro_grupo">
                                <div onclick="MostrarOcultar(this,'ul_precios');">
                                    <span class="pull-left">PRECIO</span> <span
                                            class="glyphicon glyphicon-chevron-down filtro_grupo pull-right mostrar"
                                            id="imagenmostrar"></span>
                                </div>
                                <ul id="ul_precios"
                                    class="text-left col-xs-12 ul_filtros">
                                    <br>
                                    <li class="li_subcategoria li_subcategoriaprincipal">Todos los precios</li>
                                    <br>
                                    <li onclick="opcionesbusqueda('PRECIO', 'GRATIS')" class="li_subcategoria">Gratis
                                    </li>
                                    <li onclick="opcionesbusqueda('PRECIO', 'PAGO')" class="li_subcategoria">Pagos</li>
                                </ul>
                            </div>
                            <hr class="col-xs-12">

                        </div>

                    </div>
                    <div id="mostrarfiltros" class=" panel panel-default ">
                        <div class="panel-body">
                            <div style="cursor: pointer" class="filtro_grupo">
                                <div onclick="MOresponsive(this,'filtros');">
                                    <span class="pull-left">FILTRAR RESULTADOS</span> <span
                                            class="glyphicon glyphicon-chevron-down filtro_grupo pull-right mostrar"
                                            id="imagenmostrar"></span>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
            <div class="col-xs-12 col-lg-8 col-md-8 col-sm-12 ">
                <div class="text">
                    <h2 class="text-center" id="NombreCiudad">Eventos en </h2>
                </div>
                <div class="consulta btn-group pull-right">
                    <span class=" btn btn-primary" title="Eventos Gratis" data-toggle="tooltip"
                          onclick="buscareventostipos('Gratis','{{csrf_token()}}')">Gratis</span>
                    <span class=" btn btn-success" title="Eventos Pagos" data-toggle="tooltip"
                          onclick="buscareventostipos('Pagos','{{csrf_token()}}')">Pagos</span>
                    <!--                <span class="  btn ">Populares</span>
                                    <span class="  btn ">Fechas</span>-->
                </div>
                <!-- <div class="event" id="div_eventos" name="div_eventos">
                    <div class="showbox" style="display: none" id="div_cargandoevento" name="div_cargandoevento">
                        <div class="loader">
                            <svg class="circular" viewBox="25 25 50 50">
                                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2"
                                        stroke-miterlimit="10"/>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="divcargandogeneral navbar-fixed-top" style="display: none">
                    <div class="showbox">
                        <div class="loader">
                            <svg class="circular" viewBox="25 25 50 50">
                                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2"
                                        stroke-miterlimit="10"/>
                            </svg>
                        </div>
                    </div>
                </div> -->
                <eventos></eventos>
            </div>
        </div>
    </div>
@section('script')
    <script type="text/javascript" src="{{asset('js/home.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            CargarComplementos('{{csrf_token()}}');
            _token = "{{csrf_token()}}";
        });
    </script>
@endsection
@endsection