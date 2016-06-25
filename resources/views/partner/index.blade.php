@extends('layouts.app')

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
        <h1>Gerenciar Parceiros</h1>
    </div> 
</div>
<div class="row">
    <div class="col-md-6">
        <h3>Cadastrar Parceiro</h3>
        <form class="form-inline" role="form" method="POST" action="{{ isset($partner->id) ? url('/admin/partner/edit/'.$partner->id)  : url('/admin/partner/create') }}">
            {!! csrf_field() !!}

            <div class="col-md-12">
                <div class="form-group">
                    <label for="name">Nome do parceiro:</label>
                    <input name="name" id="name" class="form-control" required="true" autofocus="true" value="{{ isset($priority->id) ? $priority->name  : "" }}">
                </div>
                <div class="form-group">
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-btn fa-user"></i>Cadastrar
                        </button>
                    </div>
                </div>    
            </div>
        </form>
    </div>
</div>


<div class="row">
    <div class="col-lg-12">
        <h3>Parceiros Cadastrados</h3>
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th class="text-center">Nome</th>
                        <th class="text-center">Estado</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($partners as $partner)
                        <tr>
                            <td class="text-center"><a href="/admin/partner/edit/{{$partner->id}}" title="Editar">{{$partner->name}}
                                </a></td>
                            @if ($partner->state === 1)
                                <td class="text-center">Ativo</td>
                            @else
                                <td class="text-center">Inativo</td>
                            @endif
                            <td class="text-center">
                                <a href="/admin/partner/edit/{{$partner->id}}" title="Editar">
                                    <i class= 'fa fa-edit'></i>
                                </a>
                                |
                                <a href="/admin/partner/delete/{{$partner->id}}" title="Deletar" onclick="return confirm('Excluir parceiro?')">
                                    <i class= 'fa fa-trash'></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center">Nenhuma parceiro cadastrado</td>
                            </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection