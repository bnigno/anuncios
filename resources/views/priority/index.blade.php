@extends('layouts.app')

@section('content')

<h1>Cadastrar Categoria de Prioridade</h1>
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

<form class="form-inline" role="form" method="POST" action="{{ isset($priority->id) ? url('/admin/priority/edit/'.$priority->id)  : url('/admin/priority/create') }}">
    {!! csrf_field() !!}

    <div class="col-md-6">
        <div class="form-group">
            <label for="name">Nome da categoria:</label>
            <input name="name" id="priorityName" class="form-control" required="true" autofocus="true">

        </div>
        <div class="form-group">
            <label for="priority">Prioridade:</label>
            <select name="priority" id="prioritu" class="form-control" required="true">
                <option value=""></option>
                @for ($i = 1; $i <= 10; $i++)
                    <option value="{{$i}}">{{$i}}</option>
                @endfor
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
<br>
<h1>Categoria de prioridades Cadastradas</h1>

<div class="row">
    <div class="col-lg-12">
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th class="text-center">Nome</th>
                        <th class="text-center">Prioridade</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($priorities as $priority)
                        <tr>
                            <td class="text-center">{{$priority->name}}</td>
                            <td class="text-center">{{$priority->priority}}</td>
                            <td class="text-center">
                                <a href="/admin/priority/edit/{{$priority->id}}" title="Editar">
                                    <i class= 'fa fa-edit'></i>
                                </a>
                                |
                                <a href="/admin/priority/delete/{{$priority->id}}" title="Deletar" onclick="return confirm('Excluir categoria de prioridade?')">
                                    <i class= 'fa fa-trash'></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center">Nenhuma categoria de prioridade cadastrada</td>
                            </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection