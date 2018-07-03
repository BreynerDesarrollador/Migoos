<?php
/**
 * Created by PhpStorm.
 * User: windows 8.1
 * Date: 12/06/2018
 * Time: 1:32 PM
 */
?>
@extends('layouts.app')
@section('content')
    <div class="w-100">
        <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="{{asset('img/img1.png')}}?auto=yes&bg=777&fg=555&text=First slide"
                         alt="Migoos evento">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="{{asset('img/img2.png')}}?auto=yes&bg=666&fg=444&text=Second slide"
                         alt="Migoos evento">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="{{asset('img/img3.png')}}?auto=yes&bg=555&fg=333&text=Third slide"
                         alt="Migoos evento">
                </div>
            </div>
            <div class="container bg-white position-absolute fixed-bottom rounded-top shadow-sm bg-white rounded">
                <div class="container p-4">
                    <strong><h1 class="text-center">Busca tú evento en el mejor lugar</h1></strong>
                    <div class="input-group mb-3 w-50 text-center container">
                        <div class="col-sm-12 col-md-6 col-xl-6">
                            <select-vue :name="'ciudad'" :opcion="'categoria'" :buscar="0"
                                        :option="{id:'',text:'Seleccione...'}"
                                        :datos="[]" :array="false">

                            </select-vue>
                        </div>

                        <!-- <input type="text" class="form-control" aria-label="Text input with dropdown button"> -->
                        <div class="input-group-prepend">
                            <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Categoria
                            </button>
                            <button type="button" class="btn btn-outline-secondary bgprimario text-light">Buscar
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <a class="dropdown-item" href="#">Something else here</a>
                                <div role="separator" class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Separated link</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row p-4">
            <div class="col-sm-12">
                <h1 class="text-center">Eventos recientes para ti.</h1>
            </div>
            <div class="col-sm-12">
                <eventos></eventos>
            </div>

        </div>
    </div>
@endsection