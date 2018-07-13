<template>
    <div>
        <!-- <loader-spinner class="preloader-background" :loading="loading" :color="'#64dd17'"></loader-spinner> -->
        <section id="carousel">
            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block w-100" src="img/img1.jpg" alt="First slide">
                        <div class="carousel-caption d-none d-md-block">
                            <h3>
                                Encuentra todo lo que está sucediendo en tu cuidad en una sola lista. </h3>
                            <p>Descubre conciertos, festivales, fiestas, happy hours y mucho más.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="img/img2.jpg" alt="Second slide">
                        <div class="carousel-caption d-none d-md-block">
                            <h3>Ya no tienes Excusas para vivir tus mejores experiencias</h3>
                            <p>Comparte todos esos momentos con las personas que quieres y vívelos al máximo.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="img/img2.jpg" alt="Third slide">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>...</h5>
                            <p>...</p>
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </section>

        <section id="busqueda">
            <div class="container-fluid">
                <div class="row">
                    <div class=" col-lg-auto col-lg-12 ">
                        <div id="buscar">
                            <div class="card card-busqueda g-grid text-center">
                                <div class="card-body ">
                                    <h1 class=" titulo card-title ">Encuentra tu próxima experiencia</h1>
                                    <div class="input-group  g-grid">
                                        <input id="caja1" name="caja1" v-model="buscar" type="text" class="form-control" placeholder="Buscar Eventos">
                                        <!-- <input id="caja2" type="text" class="form-control" placeholder="Cartagena , Bolivar , Colombia"> -->
                                        <autocompletar></autocompletar>
                                        <div id="caja3" class="input-group-prepend">
                                            <button class="btn btn-outline-success dropdown-toggle" type="button"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Todos las fechas
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="#!" @click="agregarfecha('hoy')">Hoy</a>
                                                <a class="dropdown-item" href="#!" @click="agregarfecha('manana')">Mañana</a>
                                                <a class="dropdown-item" href="#!" @click="agregarfecha('proxima')">Proxima semana</a>
                                            </div>
                                        </div>
                                        <div class="input-group-append">
                                            <button id="icon" class="btn btn-outline-success bg-color " type="button" @click="buscarciudad">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="eventos " class="container-fluid">
            <eventos></eventos>
        </section>
    </div>
</template>

<script>
    import toastr from 'toastr'
    var es;
    export default {
        data: function () {
            return {
                buscar:'',
                ciudad:'',
                fecha:'',
            }
        },
        mounted() {

        },
        created() {
            //this.loading=false;
        },
        methods: {
            agregarfecha(param) {
                this.fecha=param;
            },
            buscarciudad() {
                var ciudad=$('input[autocomplete=off]').val();
                if(ciudad!='' && ciudad!=undefined){
                    this.$router.push({name:'eventosciudad',params:{'tipo':'evento','ciudad':ciudad.split(',')[0]},query:{'buscar':this.buscar,fecha:this.fecha}});
                }else{
                    toastr.info('Campos vacios','Debe digitar por lo menos la ciudad.');
                    $('input[autocomplete=off]').focus();
                }
            }
        },

    }
</script>

<style>
    .preloader-background{
        background-color: white;
    }
</style>