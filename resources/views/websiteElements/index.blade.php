@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-md-12">
		@if (session('status'))
		<br>
		    <div class="alert alert-success" id="status">
		        <ul>
		                <li>{{ session('status') }}</li>
		        </ul>
		    </div>
		@endif
		<h1>Editar Seções da Página</h1>

		<a href="/admin/elements/terms" class="btn btn-primary">
		    Termos de uso
		</a>

		<a href="/admin/elements/advertise" class="btn btn-primary">
		    Anuncie
		</a>

		<a href="/admin/elements/banners" class="btn btn-primary">
		    Banners
		</a>
	</div>
</div>
@endsection