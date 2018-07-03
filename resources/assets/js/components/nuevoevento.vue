<template>
    <div class="container-fluid">
        <loader-spinner class="preloader-background" :loading="loading" :color="'#64dd17'"></loader-spinner>
        <form accept-charset="UTF-8" action="/guardarevento" enctype="multipart/form-data" class="form_guardar"
              method="post" role="form"
              id="form_guardar" novalidate>
            <input type="hidden" name="_token" :value="token()">
            <div class="row">
                <div class="col-sm-12 col-md-8 col-xl-8">
                    <div class="card">
                        <div class="card-header">
                            <h1 class="card-title text-center text-primary">Crear nuevo evento</h1>
                            <div class="col-sm-12 text-right">
                                <button type="submit" @click="guardardatos" class="btn btn-outline-primary"><i
                                        class="icon ion-ios-save"></i> Guardar
                                </button>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-sm-12 col-md-8 col-xl-8">
                                    <label for="nombre">Nombre del evento: <span class="text-danger font">*</span></label>
                                    <input required class="form-control" placeholder="Ej: Concierto de amor y amistad, Concierto de primavera, etc..." name="nombre" id="nombre" type="text"/>
                                </div>
                                <div class="form-group col-sm-12 col-md-4 col-xl-4">
                                    <label for="tipo">Tipo: <span class="text-danger font">*</span></label>
                                    <select-vue :name="'tipo'" :opcion="'categoria'" :buscar="''"
                                                :option="{id:'',text:'Seleccione...'}"
                                                :datos="[{id:'GRATIS',text:'GRATIS'},{id:'PAGO',text:'PAGO'}]"
                                                :array="true"></select-vue>
                                </div>
                                <div class="form-group col-sm-12 col-md-6 col-xl-6">
                                    <label for="detalle">Detalle del evento:</label>
                                    <textarea name="detalle" placeholder="Ej: Evento que se realiza cada año en la ciudad de cartagena..." id="detalle" class="form-control">

                                    </textarea>
                                </div>
                                <div class="form-group col-sm-12 col-md-6 col-xl-6">
                                    <label for="descripcion">Descripción del evento: <span class="text-danger font">*</span></label>
                                    <textarea required name="descripcion" placeholder="Describe brevemente lo que contiene el evento..." id="descripcion" class="form-control">

                                    </textarea>
                                </div>
                                <div class='col-sm-6'>
                                    <div class="form-group">
                                        <label for="fecha">Fecha del evento: <span class="text-danger font">*</span></label>
                                        <div class='input-group mb-3 date'>
                                            <input required type='text' class="form-control" name="fecha" id="fecha"/>
                                            <div class="input-group-append">
                                                <i class="input-group-text icon ion-ios-calendar"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-sm-12 col-md-6 col-xl-6">
                                    <label for="nombre">Dirección del evento: <span class="text-danger font">*</span></label>
                                    <input required class="form-control" placeholder="Ej: Centro historico, avanida plazuela #10-35 Cartagena-Bolívar" name="direccion" id="direccion" type="text"/>
                                </div>
                                <div class="form-group col-sm-12 col-md-6 col-xl-6">
                                    <label for="categoria">Categoria: <span class="text-danger font">*</span></label>
                                    <select-vue :name="'categoria'" :opcion="'categoria'" :buscar="''"
                                                :option="{id:'',text:'Seleccione...'}" :datos="[]"
                                                :array="false"></select-vue>
                                </div>
                                <div class="form-group col-sm-12 col-md-6 col-xl-6">
                                    <label for="ciudad">Ciudad: <span class="text-danger font">*</span></label>
                                    <select-vue :name="'ciudad'" :opcion="'categoria'" :buscar="0"
                                                :option="{id:'',text:'Seleccione...'}"
                                                :datos="[]" :array="false">

                                    </select-vue>
                                </div>
                                <div class="form-group col-sm-12 col-md-3 col-xl-3" v-if="costo">
                                    <label for="costo">Costo $: <span class="text-danger font">*</span></label>
                                    <input class="form-control" required placeholder="Ej: $65,000" name="costo" id="costo" type="text"/>
                                </div>
                                <div class="form-group col-sm-12 col-md-9 col-xl-9">
                                    <label for="videourl">Video (URL):</label>
                                    <input class="form-control" placeholder="Ej: https://www.youtube.com/watch?v=3tSz1I1XogE&list=RDVdNW2vi-PIY&index=12" name="videourl" id="videourl" type="url"/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-12 col-md-6 col-xl-6">
                                    <label for="latitud">Latitud: <span class="text-danger font">*</span></label>
                                    <input required readonly placeholder="Ej: 10.393074646298146" class="form-control" name="latitud" id="latitud"                                           type="text"/>

                                </div>
                                <div class="form-group col-sm-12 col-md-6 col-xl-6">
                                    <label for="longitud">longitud: <span class="text-danger font">*</span></label>
                                    <input required readonly placeholder="Ej: -75.48354557304685" class="form-control" name="longitud" id="longitud"
                                           type="text"/>
                                </div>
                                <div class="col-sm-12 col-mb-12">
                                    <label class="badge badge-info text-center m-0">Arrastre el localizador en la dirección de google map para agregar la ubicación del evento.</label>
                                    <gmap-map :center="{lat:10.3910485, lng:-75.47942569999998}"
                                              :zoom="12" map-type-id="terrain" style="width: 100%; height: 400px">
                                        <gmap-marker
                                                :key="1"
                                                :position="{lat:10.3910485,lng:-75.47942569999998}"
                                                :clickable="true"
                                                :draggable="true"
                                                :animation="2"
                                                @dragend="obtenercordenadas">
                                        </gmap-marker>
                                    </gmap-map>
                                </div>
                            </div>


                        </div>
                        <div class="card-footer">
                            <div class="col-sm-12 text-center">
                                <button type="submit" @click="guardardatos" class="btn btn-outline-primary"><i
                                        class="icon ion-ios-save"></i> Guardar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 col-xl-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title text-center text-primary">Agregar imagen al evento</h3>
                        </div>
                        <div class="card-body">
                            <input type="file" @change="fileChange" required accept="image/*" name="imagen" id="imagen" style="display: none">
                            <div class="col-sm-12 col-md-12 col-xl-12 text-center">
                                <a href="#" @click="abririmagen()"><i class="icon ion-ios-camera text-center"
                                                                      style="font-size:40px"></i></a>
                            </div>
                            <div class="col-sm-12 col-md-12 col-xl-12" v-for="da in files">
                                <img :src="da.ruta" :alt="da.name" width="100%" height="100%">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- Button trigger modal -->
        <button type="button" id="modalbutton" style="display: none" class="btn btn-primary" data-toggle="modal"
                data-target="#Modal">
            Launch demo modal
        </button>

        <!-- Modal -->
        <div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-dark text-center" id="exampleModalLabel">Mensajes de respuesta</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div v-if="Object.keys(error).length>0">
                            <h1 class="icon ion-ios-close-circle-outline text-warning text-center"></h1>
                            <h3 class="text-warning text-center">{{error.message}}</h3>
                            <ul>
                                <li v-for="er in error.errors">
                                    <span>{{er[0]}}</span>
                                </li>
                            </ul>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<style>
    .font{
        font-size: 20px;
    }
</style>
<script>
    import toastr from 'toastr'
    import axios from 'axios'
    import ajaxForm from 'jquery-form/dist/jquery.form.min.js'

    var es;
    export default {
        data: function () {
            return {
                error: [],
                loading:false,
                files:[],
                costo:false
            }
        },
        mounted() {
            es = this;
            this.init();
        },
        methods: {
            init() {
                $('#fecha').datetimepicker({
                    format: 'YYYY-MM-DD HH:mm:ss',
                    locale: 'es',
                    icons: {
                        time: 'icon ion-ios-time',
                        date: 'icon ion-ios-calendar',
                        up: 'icon ion-ios-arrow-up',
                        down: 'icon ion-ios-arrow-down',
                        previous: 'icon ion-ios-arrow-back',
                        next: 'icon ion-ios-arrow-forward',
                        today: 'icon ion-ios-today',
                        clear: 'icon ion-ios-close-circle-outline',
                        close: 'icon ion-ios-close'
                    }
                });
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                    }
                });
                $('#costo').mask("#,##0",{reverse:true});
                $("#tipo").on("change", function (e) {
                    if($(this).val()=="GRATIS"){
                        es.costo=false;
                    }else{
                        es.costo=true;
                    }
                });
            },
            obtenercordenadas(e) {
                $("#latitud").val(e.latLng.lat());
                $("#longitud").val(e.latLng.lng());
            }
            ,
            guardardatos(form) {
                this.loading=true;
                var valid = $('#form_guardar').valid();
                if (valid) {
                    $('#form_guardar').ajaxForm({
                        complete: function (response) {
                            if (response.responseJSON.msj=='OK') {
                                toastr.success('Registro exitoso.', 'El evento se ha creado con exito.');
                                $("#form_guardar").resetForm();
                                es.loading = false;
                                es.$router.push({name:'home'});
                            } else {
                                var msg = response.responseJSON;
                                es.error = msg;
                                $("#Modal").modal('show');
                            }
                            this.loading=false;
                        },
                        error: function (error) {
                            var msg = error.responseJSON;
                            es.error = msg;
                            $("#Modal").modal('show');
                            this.loading=false;
                        }
                    });

                } else {
                    toastr.warning('Campos vacios', 'Debe rellenar todos los campos obligatorios.');
                }
                this.loading=false;
            },
            abririmagen() {
                $('#imagen').click();
            },
            token() {
               return $('meta[name="csrf-token"]').attr('content');
            },
            fileChange(fileList) {
                es.files=[];
                let uploadedFiles = document.getElementById("imagen").files;

                /*
                  Adds the uploaded file to the files array
                */
                for( var i = 0; i < uploadedFiles.length; i++ ){
                    var f = uploadedFiles[i];
                    //this.files.push( uploadedFiles[i] );
                    //this.FormData.append('files[' + i + ']', uploadedFiles[i]);
                    var reader = new FileReader();

                    reader.onload = (function(theFile) {
                        return function(e) {
                            // Insertamos la imagen
                            //document.getElementById("list").innerHTML = ['<img class="thumb" src="', ,'" title="', escape(theFile.name), '"/>'].join('');
                            es.files.push({name: f,ruta: e.target.result});
                        };
                    })(f);

                    reader.readAsDataURL(f);
                }
            },
        },
        updated() {
            $('#costo').mask("#,##0",{reverse:true});
        }
    }
</script>