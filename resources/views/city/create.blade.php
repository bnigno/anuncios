@extends('layouts.app')

@section('content')
<h1>Cadastrar Cidade</h1>
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form class="form-horizontal" role="form" method="POST" action="{{ isset($city->id) ? url('/city/edit/'.$city->id)  : url('/city/create') }}">
    {!! csrf_field() !!}

    <div class="form-group">
        <label class="col-md-4 control-label">Nome *</label>

        <div class="col-md-4">
            <input type="text" class="form-control" name="name" value="{{ isset($city->name) ? $city->name : '' }}"  autofocus="true">
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-6 col-md-offset-4">
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-btn fa-user"></i>Cadastrar
            </button>
        </div>
    </div>
</form>
    <script src="{{url('js/main.js')}}"></script>

@endsection