<template>
    <div class="container-fluid">
        <div class="container">
            <h2 class="enunciado text-center position-relative">Eventos populares en
                <b>{{ciudadgeneral}}</b>
            </h2>
            <div class="row">
                <eventos-hoy-manana></eventos-hoy-manana>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-4 col-lg-4"  v-for="da in datos">
                    <div class="card">
                        <img class="card-img-top" :src="da.imagenpath+'thumbnail330/'+da.imagen" :alt="'Migoos en '+da.ciudad">
                        <span class="poster-card__label">{{da.tipo=='GRATIS'?da.tipo:da.costo}}</span>
                        <div class="card-body">
                            <h5 class="card-title">{{da.nombre}}</h5>
                            <p class="card-text text-truncate">
                                {{da.direccion}}
                            </p>
                            <p class="card-text">
                                <small class="text-muted">Last updated 3 mins ago</small>
                            </p>
                        </div>
                        <div class="card-footer text-muted text-center">
                            <i class="icon ion-ios-time"></i> <timeago :since="da.fechacreacion" locale="es-ES"></timeago>
                        </div>
                    </div>

                </div>
            </div>
            <infinite-loading @infinite="cargareventos" ref="infiniteLoading">
                    <span slot="no-more" class="alert alert-info">

                    </span>
            </infinite-loading>
        </div>

    </div>
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
        data: function () {
            return {
                datos: [],
                ubicacion:{},
                ciudadgeneral:''
            }
        },
        mounted() {
            es=this;
            //this.cargareventos(0,0,0);
            this.ciudadgeneral=ciudadgeneral;
        },
        methods: {
            cargareventos ($state){
                axios.post('/cargareventos',{"lat":0,"long":0,"accuracy":0})
                    .then(data => {
                        $state.loaded();
                        this.datos=data.data;
                        $state.complete();
                    }).catch(error => {
                        toastr.warning('Error',error.response.data.message);
                        $state.complete();
                    });
            },
            ubicacionactual() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function(position) {
                        es.ubicacion = {
                            lat: position.coords.latitude,
                            long: position.coords.longitude
                        };
                        es.cargareventos(position.coords.latitude,position.coords.longitude,position.coords.accuracy);
                    }, function() {
                        es.cargareventos('','');
                    });
                } else {
                    es.cargareventos('','');
                }

            }
        }
    }
</script>
<style>
    .card-img-top{
        width:100%;
        hegiht:200px;
        position:relative;
    }
</style>