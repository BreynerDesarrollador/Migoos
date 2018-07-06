<?php
/**
 * Created by PhpStorm.
 * User: windows 8.1
 * Date: 06/07/2018
 * Time: 11:33 AM
 */
?>
@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12 pt-5 pb-5">
                <div class="card">
                    <div class="card-header text-center">Registro exitoso</div>
                    <div class="card-body text-center">
                        Se ha registrado exitosamente. Hemos enviado un correo de verificación a <strong>{{$correo}}</strong>. <br>
                        Gracias por preferirnos.</a>
                    </div>
                    <div class="card-footer text-muted text-center">
                        <label>migoos.com.co</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
