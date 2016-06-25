@extends('layouts.app')

@section('title')
    Gerenciar Cidades - Vips Brasil
@endsection

@section('content')
<br>
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

<h1>Cadastrar Cidade</h1>
<div class="row">
    <form class="form-inline" role="form" method="POST" action="{{ isset($city->id) ? url('/admin/city/edit/'.$city->id)  : url('/admin/city/create') }}">
        {!! csrf_field() !!}

        <div class="col-md-10">
            <div class="form-group">
                <label for="cod_estados">Estado:</label>
                <select name="cod_estados" id="estados_cod_estados" class="form-control" required>
                    <option value=""></option>
                    @foreach ($estados as $estado)
                        <option value="{{$estado->cod_estados}}">{{$estado->sigla}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="cod_estados">Cidade:</label>
                <select name="cod_cidades" id="cod_cidades" class="form-control" required>
                    <option value="">-- Escolha um estado --</option>
                </select>
            </div>
            <div class="form-group">
                <div class="col-md-6">
                    <button type="submit" class="btn btn-primary">
                        <i class="glyphicon glyphicon-floppy-disk"></i> Cadastrar
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

<h1>Cidades Cadastradas</h1>

<div class="row">
    <div class="col-lg-12">
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th class="text-center">Estado</th>
                        <th class="text-center">Cidade</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($cities as $city)
                        <tr>
                            <td class="text-center">{{$city->sigla}}</td>
                            <td class="text-center">{{$city->nome}}</td>
                            <td class="text-center">
                                <a href="/admin/city/delete/{{$city->id}}" title="Deletar" onclick="return confirm('Excluir cidade? Anúncios vinculados a esta cidade deverão ser atribuídos a outra cidade para serem exibidos')">
                                    <i class= 'fa fa-trash'></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center">Nenhuma cidade cadastrada</td>
                            </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
    
@endsection

@section('footer')
    <script src="{{url('js/main.js')}}"></script>
@endsection