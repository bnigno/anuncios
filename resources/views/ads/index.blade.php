@extends('layouts.app')

@section('title')
    Gerencia Anuncios - Vips Brasil
@endsection

@section('content')

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('status'))
    <div class="alert alert-success" id="status">
        <ul>
                <li>{{ session('status') }}</li>
        </ul>
    </div>
@endif
<div class="row">
    <div class="col-md-6">
        <h1>Gerenciar Anúncios</h1>
    </div> 
</div>

<div class="row">
    <div class="col-lg-4">
        <a href="/admin/ads/create" class="btn btn-primary">
            <i class="fa fa-btn fa-plus"></i> Novo Anúncio
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <h3>Pesquisar</h3>
        <form class="form-inline" role="form" method="GET" action="/admin/ads/search">
            {!! csrf_field() !!}

            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">Nome:</label>
                    <input name="name" id="name" class="form-control" autofocus="true">
                </div>
                <div class="form-group">
                    <label for="city">Cidade:</label>
                    <select name="city" id="city" class="form-control">
                        <option value="" disabled selected hidden>Selecione</option>
                        @forelse ($cities as $city)
                            <option value="{{$city->id}}">{{$city->nome}}</option>
                        @empty
                            <p name="priority">Nenhuma cidade cadastrada. <a href="{{url('/admin/city')}}">Cadastre uma primeiro</a></p>
                        @endforelse
                    </select>
                </div>
                <div class="form-group">
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-btn fa-search"></i> Pesquisar
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <h3>Anúncios</h3>
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th class="text-center">Nome</th>
                        <th class="text-center">Cidade</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($ads as $ad)
                        <tr>
                            <td class="text-center"><a href="/admin/ads/edit/{{$ad->id}}" title="Editar">{{$ad->name}}
                            </a></td>
                            <td class="text-center">{{$ad->nome}}</td>
                            <td class="text-center">
                                <a href="/admin/ads/edit/{{$ad->id}}" title="Editar">
                                    <i class= 'fa fa-edit'></i>
                                </a>
                                |
                                <a href="/admin/ads/midia/{{$ad->id}}" title="Enviar mídia">
                                    <i class= 'fa fa-upload'></i>
                                </a>
                                |
                                <a href="/admin/ads/delete/{{$ad->id}}" title="Deletar" onclick="return confirm('Excluir anúncio?')">
                                    <i class= 'fa fa-trash'></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center">Nenhuma anúncio cadastrado</td>
                            </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection