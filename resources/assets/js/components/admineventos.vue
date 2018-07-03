<template>
    <div class="container-fluid">
        <loader-spinner class="preloader-background" :loading="loading" :color="'#64dd17'"></loader-spinner>
        <div class="card">
            <div class="card-header">
                <h4 class="text-center text-dark">Todos los eventos</h4>
            </div>
            <div class="card-body">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-left text-dark">Lista de eventos</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12 col-md-3 col-xl-3" v-for="da in datos">
                                <div class="card shadow-sm" style="width: 18rem;">
                                    <img class="card-img-top" :src="'/'+da.imagenpath+'thumbnail330/'+da.imagen+'?text=Image cap'" alt="Card image cap">
                                    <div class="card-body">
                                        <h5 class="card-text text-primary text-truncate">
                                            {{da.nombre}}
                                        </h5>
                                        <small class="card-text text-muted">
                                            {{da.direccion}}
                                        </small>
                                        <p>
                                            <a href="#!" class="card-text">
                                                @{{da.categoria}}, #{{da.tipo_evento}}
                                            </a>
                                        </p>

                                    </div>
                                    <div class="card-footer text-center">
                                        <router-link :to="{name:'edit',params:{id:da.id}}" class="card-link"  v-tooltip="'Editar evento'"><i class="icon ion-ios-build"></i></router-link>
                                        <a href="#!" class="card-link" v-tooltip="'Agregar a favorito'" @click="agregarfavorito(da.id,da.favorito)"><i :class="[da.favorito==0?'icon ion-ios-star':'icon ion-ios-star text-danger']" :id="'favorito'+da.id"></i></a>
                                        <a href="#!" class="card-link" v-tooltip="'Eliminar evento'" @click="eliminarevento(da.id)"><i class="icon ion-ios-trash"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <h3 class="blockquote-footer">
                            Migoos.com
                        </h3>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <h3 class="blockquote-footer">
                    Migoos.com
                </h3>
            </div>
        </div>
    </div>
</template>
<script>
    import axios from 'axios'
    import toastr from 'toastr'
    import Nuevoevento from "./nuevoevento";

    export default {
        components: {Nuevoevento},
        data: function () {
            return {
                datos: [],
                loading:false,
                msg:'esto es una prueba'
            }
        },
        created() {
            //this.cargareventos();
        },
        mounted() {
            this.cargareventos();
        },
        methods: {
            cargareventos() {
                this.loading=true;
                axios.post('/cargareventos')
                    .then(data => {
                    this.datos = data.data;
                    this.loading=false;
            }).catch(error => {
                    toastr.warning('Error', error.responseText);
                this.loading=false;
            });
            },
            eliminarevento(id) {
                if(confirm('Desea eliminar el evento seleccionado ?')){
                    axios.delete('/eliminarevento/'+id)
                        .then(data =>{
                        toastr.success('Eliminación exitosa', 'El evento se ha eliminado con exito.');
                        var posicion=this.datos.findIndex(da => da.id===data.data);
                        this.datos.splice(posicion,1);
                    }).catch(error =>{
                        toastr.danger('Error', error.responseText);
                    })
                }

            },
            agregarfavorito(id,favorito) {
                axios.post('/favorito/'+id+'/'+(favorito==1?0:1))
                    .then(data =>{
                        var da=this.datos.find(x => x.id==data.data.id);
                        da.favorito=data.data.favorito;
                        if(data.data.favorito==1){
                            $("#favorito"+data.data.id).addClass('text-danger');
                        }else{
                            $("#favorito"+data.data.id).removeClass('text-danger');
                        }

                }).catch(error =>{
                    toastr.danger('Error', error.responseText);
                });
            }
        }
    }
</script>