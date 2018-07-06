<template>
    <div class="container-fluid">
        <h2 class="enunciado text-center position-relative">Eventos populares en
            <b>{{ciudadgeneral}}</b>
        </h2>

        <div class="row">
            <div class="col-sm-12 col-md-3 col-lg-3"  v-for="da in datos">
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
                ciudadgeneral:''
            }
        },
        mounted() {
            es=this;
            this.cargareventos(0,0,0);
            this.ciudadgeneral=ciudadgeneral;
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