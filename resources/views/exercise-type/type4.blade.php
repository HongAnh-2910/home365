@extends('app')
@section('content')
    <div class="section-exercise-type position-relative">
        <img class="section-image-bg section-img-pc d-sm-block d-none" src="{{asset('images/escape_princess_pc.png')}}" />
        <img class="section-image-bg section-img-mb d-sm-none d-block" src="{{asset('images/escape_princess_pc.png')}}" />
        @include('exercise-type.header_type')
    </div>
@endsection
