@extends('landing.layouts.layout')

@section('title', $title)

@section('content')
<div class="container my-5">
    <div class="row p-4 pb-0 pe-lg-0 pt-lg-5 align-items-center rounded-3 border shadow-lg">
      <div class="col-lg-7 p-3 p-lg-5 pt-lg-3">
        <h1 class="display-4 fw-bold lh-1">Selamat Datang di Aplikasi Ujian</h1>
        <p class="lead">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Necessitatibus deserunt ad nam laborum nemo odio ipsum, quidem ipsa minima! Illum eos cum quidem animi molestiae sunt fugit autem ad eum?</p>
      </div>
      <div class="col-lg-4 offset-lg-1 p-0 overflow-hidden shadow-lg">
          <img class="rounded-lg-3" src="{{ asset('assets/img/landing.jpg') }}" alt="">
      </div>
    </div>
</div>
@endsection