<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-md-4 col-xs-4" v-for="da in datos">
                <div class="card mb-3">
                    <div class="card-img-top">
                        <img :src="da.imagenpath+'thumbnail330/'+da.imagen" :alt="'Migoos en '+da.ciudad" width="100%" height="200px">
                        <span class="text-left badge badge-primary position-absolute">{{da.fecha}}</span>
                        <span class="text-right badge badge-success">{{da.tipo=='GRATIS'?da.tipo:da.costo}}</span>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title text-center text-dark"><i class="icon ion-ios-star-outline"></i> {{da.nombre}}</h5>
                        <p class="card-text"><i class="cion ion-ios-pin"></i> {{da.direccion}}</p>
                        <p class="card-text">
                            <small class="text-muted"><i class="icon ion-ios-time"></i> <timeago :since="da.fechacreacion" locale="es-ES"></timeago></small>
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>
<script>
    import axios from 'axios'
    import toastr from 'toastr'
    var es;
    export default{
        data: function () {
            return {
                datos: [],
                ubicacion:{},
            }
        },
        mounted() {
            es=this;
            this.ubicacionactual();
        },
        methods: {
            cargareventos (lat,long,accuracy){
                axios.post('/cargareventos',{"lat":lat,"long":long,"accuracy":accuracy})
                    .then(data => {
                        this.datos=data.data;
                        //toastr.success('Error',data.data.latitud);
                    }).catch(error => {
                        toastr.warning('Error',error.response.data.message);
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