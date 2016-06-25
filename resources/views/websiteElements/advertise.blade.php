@extends('layouts.app')

@section('content')
<script src="//cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>
<script type="text/javascript">
    CKEDITOR.replace( 'advertise',
    {
        customConfig : 'config.js',
        language: 'pt-br',
        toolbar : 'simple'
    })
</script> 
<div class="row">
    <div class="col-md-12">
        <h1>Anuncie</h1>

        <form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/elements/advertise') }}">
            {!! csrf_field() !!}
            <div class="form-group">
                <div class="col-md-12">
                    <textarea id="advertise" name="advertise" rows="10" class="form-control ckeditor" maxlength="1000">{{isset($advertise->advertise) ? $advertise->advertise : ''}}</textarea>
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