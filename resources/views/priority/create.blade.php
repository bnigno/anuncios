@extends('layouts.app')

@section('content')
<h1>Cadastrar Categoria de Prioridade</h1>

<form class="form-inline" role="form" method="POST" action="{{ isset($priority->id) ? url('/admin/priority/edit/'.$priority->id)  : url('/admin/priority/create') }}">
    {!! csrf_field() !!}

    <div class="col-md-6">
        <div class="form-group">
            <label for="name">Nome da categoria:</label>
            <input name="name" id="priorityName" class="form-control" required="true" autofocus="true" value="{{ isset($priority->id) ? $priority->name  : "" }}">

        </div>
        <div class="form-group">
            <label for="priority">Prioridade:</label>
            <select name="priority" id="priority" class="form-control" required="true">
                <option value=""></option>
                @for ($i = 1; $i <= 10; $i++)
                    @if ($i === $priority->priority)
                        <option value="{{$i}}" selected="true">{{$i}}</option>
                    @else
                        <option value="{{$i}}">{{$i}}</option>
                    @endif
                @endfor
            </select>
        </div>
        <div class="form-group">
            <div class="col-md-6">
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-btn fa-user"></i>Alterar
                </button>
            </div>
        </div>
    </div>
</form>
@endsection