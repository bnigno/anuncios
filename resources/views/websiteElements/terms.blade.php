@extends('layouts.app')

@section('content')
<script src="//cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>
<script type="text/javascript">
    CKEDITOR.replace( 'terms',
    {
        customConfig : 'config.js',
        language: 'pt-br',
        toolbar : 'simple'
    })
</script> 
@if (session('status'))
    <div class="alert alert-success" id="status">
        <ul>
                <li>{{ session('status') }}</li>
        </ul>
    </div>
@endif
<div class="row">
    <div class="col-md-12">
        <h1>Termos de Uso</h1>

        <form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/elements/terms') }}">
            {!! csrf_field() !!}
            <div class="form-group">
                <div class="col-md-12">
                    <textarea id="terms" name="terms" rows="10" class="form-control ckeditor" placeholder="Escreva os seus termos de uso.." maxlength="1000">{{isset($terms->terms) ? $terms->terms : ''}}</textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-btn fa-save"></i> Salvar
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection