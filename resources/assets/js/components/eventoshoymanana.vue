<template>
    <section id="eventoshoymanana" class="p-3 pb-4 w-100">

        <div class="container">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-xl-6" :class="{'offset-3':datos.hoy.length>0 && datos.manana.length==0}">
                        <div class="list-group" v-if="datos.hoy.length>0">
                            <a href="#!" class="list-group-item list-group-item-action active">
                                Eventos para hoy
                                <span class="badge badge-warning badge-pill float-right text-white">{{datos.hoy.length}}</span>
                            </a>
                            <a href="#" v-for="da in datos.hoy" class="list-group-item list-group-item-action flex-column align-items-start">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">{{da.nombre}}</h5>
                                    <h5><i class="icon ion-ios-time"></i>  <small><strong>{{convertirfechatiempo(da.fecha)}}</strong></small></h5>
                                </div>
                                <p class="mb-1 text-truncate">{{da.direccion}}</p>
                                <small class="badge badge-warning float-left text-white">{{da.tipo}}</small>
                                <small class="badge badge-warning float-right text-white" v-if="da.costo!='' && da.costo!=0">{{convertirmoneda(da.costo)}}</small>
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-xl-6">
                        <div class="list-group" v-if="datos.manana.length>0">
                            <a href="#" class="list-group-item list-group-item-action active">
                                Eventos para mañana
                                <span class="badge badge-warning badge-pill float-right text-white">{{datos.hoy.length}}</span>
                            </a>
                            <a href="#" v-for="da in datos.manana" class="list-group-item list-group-item-action flex-column align-items-start">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">{{da.nombre}}</h5>
                                    <h5><i class="icon ion-ios-time"></i>  <small><strong>{{convertirfechatiempo(da.fecha)}}</strong></small></h5>
                                </div>
                                <p class="mb-1 text-truncate">{{da.direccion}}</p>
                                <small class="badge badge-warning float-left text-white">{{da.tipo}}</small>
                                <small class="badge badge-warning float-right text-white" v-if="da.costo!='' && da.costo!=0">{{convertirmoneda(da.costo)}}</small>
                            </a>
                        </div>
                    </div>
                    <infinite-loading @infinite="cargareventoshoymanana" ref="infiniteLoading">
                        <span slot="no-more" class="alert alert-info">

                        </span>
                    </infinite-loading>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    import axios from 'axios'
    import toastr from 'toastr'
    import InfiniteLoading from 'vue-infinite-loading';
    var es;

    export default{
        components: {
            InfiniteLoading
        },
        data: function() {
            return {
                datos:{hoy:[],manana:[]},
            }
        },
        mounted() {
          es=this;
        },
        methods: {
            cargareventoshoymanana($state){
                try{

                    axios.get('/eventos.hoymanana')
                        .then(({data}) =>{
                            $state.loaded();

                        $.each(data,function (index,value) {
                            if(value.dia=="hoy"){
                                es.datos.hoy.push(value);
                            }else{
                                es.datos.manana.push(value);
                            }
                        });
                        $state.complete();
                    });
                }catch (e) {
                    toastr.warning('Error',e.responseText);
                    $state.complete();
                }
            },
            convertirfecha(fecha) {
                var datos=fechastring(fecha);
                return datos.nombre_dia+' '+datos.dia_mes+' de '+datos.nombre_mes+', '+datos.ano;

            },
            convertirfechatiempo(fecha) {
                var datos=fechastring(fecha);
                return datos.horas+':'+datos.minutos;

            },
            convertirmoneda(costo) {
                return convertirmoneda(costo);
            },
        }
    }

</script>