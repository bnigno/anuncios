@extends('layouts.app')

@section('title')
    {{ isset($ad->id) ? 'Editar Anúncio - Vips Brasil'  : 'Criar Anúncio - Vips Brasil' }}
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
    <div class="col-md-9">
        @if (isset($ad->id))
            <h1>Editar Anúncio 
                <small>
                    <a href="{{url('/admin/ads/midia/'.$ad->id)}}" class="btn btn-default">
                        <i class="fa fa-upload"></i> Enviar Mídia
                    </a>
                    <a href="{{url('/anuncios/acompanhante/'.$ad->id)}}" target="_blank" class="btn btn-default">
                        <i class="fa fa-eye"></i> Ver Anúncio
                    </a>
                </small> 
            </h1>
        @else
            <h1>Cadastrar Anúncio</h1>
        @endif
        
        <form class="form-horizontal" role="form" method="POST" action="{{ isset($ad->id) ? url('/admin/ads/edit/'.$ad->id)  : url('/admin/ads/create') }}">
            {!! csrf_field() !!}

            <div class="col-md-12">
                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">*Nome:</label>
                    <div class="col-sm-10">
                        <input name="name" id="name" class="form-control" required="true" autofocus="true" value="{{ isset($ad->id) ? $ad->name  : "" }}">
                    </div>  
                </div>
                <div class="form-group">
                    <label for="phone" class="col-sm-2 control-label">*Telefone:</label>
                    <div class="col-sm-10">
                        <input name="phone" id="phone" class="form-control telefone" required="true" value="{{ isset($ad->phone) ? $ad->phone  : "" }}">
                    </div>  
                </div>
                <div class="form-group">
                    <label for="price" class="col-sm-2 control-label">*Preço:</label>
                    <div class="col-sm-10">
                        <div class="input-group">
                            <div class="input-group-addon">R$</div>
                            <input type="number" name="price" id="price" class="form-control" required="true" value="{{ isset($ad->price) ? $ad->price  : "" }}" placeholder="Ex: 450" step="0.01">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="age" class="col-sm-2 control-label">*Idade:</label>
                    <div class="col-sm-10">
                        <input type="number" name="age" id="age" class="form-control" required="true" value="{{ isset($ad->age) ? $ad->age  : "" }}" placeholder="Ex: 22" min="18">
                    </div>
                </div>
                <div class="form-group">
                    <label for="service" class="col-sm-2 control-label">*Atendimento:</label>
                    <div class="col-sm-10">
                        <input name="service" id="service" class="form-control" required="true" value="{{ isset($ad->service) ? $ad->service  : "" }}" placeholder="Ex: 24h, somente homens" maxlength="100">
                    </div>
                </div>
                <div class="form-group">
                    <label for="idCity" class="col-sm-2 control-label">*Cidade de Atendimento:</label>
                    <div class="col-sm-10">
                        @if (sizeof($cities)>0)
                            <select name="idCity" required>
                            @if (!isset ($ad->idCity))
                                <option value="" disabled selected hidden>Selecione</option>
                            @endif
                            @foreach ($cities as $city)
                                @if (isset ($ad->idCity) && $ad->idCity===$city->id)
                                    <option value="{{$city->id}}" selected>{{$city->nome}}</option>
                                @else
                                    <option value="{{$city->id}}">{{$city->nome}}</option>
                                @endif
                            @endforeach
                            </select>
                        @else
                            <p name="city">Nenhuma cidade cadastrada. <a href="{{url('/admin/city')}}">Cadastre uma primeiro</a></p>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label for="featured" class="col-sm-2 control-label">Destaque:</label>
                    <div class="col-sm-10">
                        @if (isset ($ad) && $ad->featured===1)
                            <input type="checkbox" name="featured" value="1" checked><br>
                        @else
                            <input type="checkbox" name="featured" value="1"><br>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label for="startDate" class="col-sm-2 control-label">*Início do anúncio:</label>
                    <div class="col-sm-10">
                        <input type="date" name="startDate" id="startDate" class="form-control" required="true" value="{{ isset($ad->startDate) ? $ad->startDate  : "" }}">
                    </div> 
                </div>
                <div class="form-group">
                    <label for="endDate" class="col-sm-2 control-label">*Fim do anúncio:</label>
                    <div class="col-sm-10">
                        <input type="date" name="endDate" id="endDate" class="form-control" required="true" value="{{ isset($ad->endDate) ? $ad->endDate  : "" }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="bornCity" class="col-sm-2 control-label">Naturalidade:</label>
                    <div class="col-sm-10">
                        <input name="bornCity" id="bornCity" class="form-control" value="{{ isset($ad->bornCity) ? $ad->bornCity  : "" }}" placeholder="Ex: Belém" maxlength="150">
                    </div>
                </div>
                <div class="form-group">
                    <label for="weight" class="col-sm-2 control-label">Peso:</label>
                    <div class="col-sm-10">
                        <div class="input-group">
                            <input type="number" name="weight" id="weight" class="form-control" value="{{ isset($ad->weight) ? $ad->weight  : "" }}" placeholder="Ex: 72" step="0.01" min="0">
                            <div class="input-group-addon">kg</div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="height" class="col-sm-2 control-label">Altura:</label>
                    <div class="col-sm-10">
                        <div class="input-group">
                            <input type="number" name="height" id="height" class="form-control" value="{{ isset($ad->height) ? $ad->height  : "" }}" placeholder="Ex: 1.72" step="0.01" min="0">
                            <div class="input-group-addon">m</div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="hairColor" class="col-sm-2 control-label">Cor do cabelo:</label>
                    <div class="col-sm-10">
                        <input name="hairColor" id="hairColor" class="form-control" value="{{ isset($ad->hairColor) ? $ad->hairColor  : "" }}" placeholder="Ex: castanho" maxlength="100">
                    </div>
                </div>
                <div class="form-group">
                    <label for="eyeColor" class="col-sm-2 control-label">Cor dos Olhos:</label>
                    <div class="col-sm-10">
                        <input name="eyeColor" id="eyeColor" class="form-control" value="{{ isset($ad->eyeColor) ? $ad->eyeColor  : "" }}" placeholder="Ex: azuis" maxlength="100">
                    </div>
                </div>
                <div class="form-group">
                    <label for="race" class="col-sm-2 control-label">Cor:</label>
                    <div class="col-sm-10">
                        <input name="race" id="race" class="form-control" value="{{ isset($ad->race) ? $ad->race  : "" }}" placeholder="Ex: branca" maxlength="100">
                    </div>
                </div>
                <div class="form-group">
                    <label for="size" class="col-sm-2 control-label">Manequim:</label>
                    <div class="col-sm-10">
                        <input type="number" name="size" id="size" class="form-control" value="{{ isset($ad->size) ? $ad->size  : "" }}" placeholder="Ex: 38">
                    </div>
                </div>
                <div class="form-group">
                    <label for="hip" class="col-sm-2 control-label">Quadril:</label>
                    <div class="col-sm-10">
                        <input type="number" name="hip" id="hip" class="form-control" value="{{ isset($ad->hip) ? $ad->hip  : "" }}" placeholder="Ex: 98">
                    </div>
                </div>
                <div class="form-group">
                    <label for="description" class="col-sm-2 control-label">Descrição:</label>
                    <div class="col-sm-10">
                        <textarea name="description" id="description" class="form-control" placeholder="Descrição do anúncio..." maxlength="300">{{ isset($ad->description) ? $ad->description  : "" }}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="travel" class="col-sm-2 control-label">Viaja:</label>
                    <div class="col-sm-1">
                        @if (isset ($ad) && $ad->travel===1)
                            <input type="checkbox" name="travel" value="1" checked><br>
                        @else
                            <input type="checkbox" name="travel" value="1"><br>
                        @endif
                    </div>
                    <label for="oral" class="col-sm-2 control-label">Oral:</label>
                    <div class="col-sm-1">
                        @if (isset ($ad) && $ad->oral===1)
                            <input type="checkbox" name="oral" value="1" checked><br>
                        @else
                            <input type="checkbox" name="oral" value="1"><br>
                        @endif
                    </div>
                    <label for="anal" class="col-sm-2 control-label">Anal:</label>
                    <div class="col-sm-1">
                        @if (isset ($ad) && $ad->anal===1)
                            <input type="checkbox" name="anal" value="1" checked><br>
                        @else
                            <input type="checkbox" name="anal" value="1"><br>
                        @endif
                    </div>
                    <label for="kiss" class="col-sm-2 control-label">Beija:</label>
                    <div class="col-sm-1">
                        @if (isset ($ad) && $ad->kiss===1)
                            <input type="checkbox" name="kiss" value="1" checked><br>
                        @else
                            <input type="checkbox" name="kiss" value="1"><br>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary">
                            <i class="glyphicon glyphicon-floppy-disk"></i> Salvar
                        </button>
                    </div>
                </div>
                
            </div>
        </form>
    </div>
</div>
@endsection

@section ('footer')
<script src="{{asset('vendor/maskbrphone/maskbrphone.js')}}"></script>
<script type="text/javascript">
    $('.telefone').maskbrphone({  
        useDdd           : true, // Define se o usuário deve digitar o DDD  
        useDddParenthesis: true,  // Informa se o DDD deve estar entre parênteses  
        dddSeparator     : ' ',   // Separador entre o DDD e o número do telefone  
        numberSeparator  : '-'    // Caracter que separa o prefixo e o sufixo do telefone  
    });
</script>
@endsection