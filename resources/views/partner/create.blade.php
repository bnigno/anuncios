@extends('layouts.app')

@section('title')
    Gerenciar Parceiros - Vips Brasil
@endsection

@section('header')
    <link rel="stylesheet" href="<?php echo asset('vendor/dropzoner/dropzone/dropzone.min.css'); ?>">
@endsection

@section('content')
<!-- <script src="{{url('js/dropzone.js')}}"></script>
<link href="{{url('css/dropzone.css')}}" rel="stylesheet"> -->
<script src="<?php echo asset('vendor/dropzoner/dropzone/dropzone.min.js'); ?>"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="<?php echo asset('vendor/dropzoner/dropzone/config.js'); ?>"></script>
<div class="row">
    <div class="col-md-12">
        <h1>Parceiro</h1>
        <form class="form-inline" role="form" method="POST" action="{{ isset($partner->id) ? url('/admin/partner/edit/'.$partner->id)  : url('/admin/partner/create') }}">
            {!! csrf_field() !!}

            <div class="col-md-12">
                <div class="form-group">
                    <label for="name">Nome:</label>
                    <input name="name" id="name" class="form-control" required="true" autofocus="true" value="{{ isset($partner->id) ? $partner->name  : "" }}">
                </div>
                <div class="form-group">
                    <label for="site">Site:</label>
                    <input type="url" name="site" id="site" class="form-control" required="true" value="{{ isset($partner->site) ? $partner->site  : "" }}">
                </div>
                <div class="form-group">
                    <label for="state">Ativo:</label>
                    @if ($partner->state===1)
                        <input type="checkbox" name="state" value="1" checked><br>
                    @else
                        <input type="checkbox" name="state" value="1"><br>
                    @endif
                </div>
                <div class="form-group">
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-btn fa-user"></i>Salvar
                        </button>
                    </div>
                </div>    
            </div>
        </form>
    </div>
</div>

@if ($partner->banner === "")
    <div class="row">
            <div class="col-md-6">
                <p><b>Enviar imagem do banner (230x385 px):</b></p>
                <div class="container">
                    <div class="dropzone" id="banner">
                    </div>
                </div>
            </div>
    </div> 

    <script type="text/javascript">
            var baseUrl = "{{ url('/') }}";
            var token = "{{ Session::getToken() }}";
            Dropzone.autoDiscover = false;
            var myDropzone = new Dropzone("div#banner", {
                url: baseUrl + "/upload/banner",
                params: {
                    _token: token
                },
                dictDefaultMessage: 'Clique ou arraste e solte seu arquivo aqui',
                maxFiles: 1,
                maxFilesize: 6,
                acceptedFiles: 'image/*',
                dictInvalidFileType: 'Você não pode enviar arquivos neste formato',
                dictFileTooBig: 'Este arquivo é maior do que o permitido.',
            });
            Dropzone.options.myAwesomeDropzone = {
                paramName: "file", // The name that will be used to transfer the file
                maxFilesize: 6, // MB
                addRemoveLinks: true,
                
                dictDefaultMessage: 'Clique ou arraste e solte seu arquivo aqui',
                accept: function(file, done) {
     
                },
            };
        </script>    
@else
<div class="row">
    <div class="col-md-12">
        <img src="{{url('img/'.$partner->banner.'?w=800&h=600&fit=max')}}">
        <p><a href="{{url('/upload/delete?filename='.$partner->banner)}}">Remover Imagem</a>
    </div>
</div>
@endif
    

@endsection