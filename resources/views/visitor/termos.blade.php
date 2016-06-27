@extends('layouts.template')
@section('title')
  {{$title}} - Vips Brasil
@endsection


@section('content')
<div class="section-heading-page">
  <div class="container">
    <div class="row">
      <div class="col-sm-6">
        <h1 class="heading-page text-center-xs">{{$title}}</h1>
      </div>
    </div>
  </div>
</div>

<div class="container">
  <div class="row">
    <div class="col-md-9">

<!--SECTION -->
<!--===============================================================-->
      <div class="section">
        <div class="container">
          <div class="row" id="progress-bar-count">
            <div class="col-md-9">
              {!!isset($terms->terms) ? $terms->terms : ''!!}
              {!!isset($terms->advertise) ? $terms->advertise : ''!!}
            </div>
          </div>
        </div>
      </div>
    </div>
    @include('visitor.sidebar')
  </div>
</div>   
@endsection