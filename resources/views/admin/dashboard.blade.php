@extends('admin.layouts.layout')

@section('title', $title)

@push('css')
<style>
    .content-header {
        margin-bottom: 1rem;
    }

    /* .content {
        margin-top: 80px;
    } */
</style>
@endpush

@section('content')
<div class="col py-3">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-12 col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div>
                <div class="col-12 col-sm-6" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb float-end">
                        <li class="breadcrumb-item">
                            <a href="#">Aplikasi Ujian</a>
                        </li>
                        <li class="breadcrumb-item active">
                            Dashboard
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="card text-bg-dark">
                        <div class="card-header">
                            <h4>Jumlah Guru</h4>
                        </div>
                        <div class="card-body">
                            <div class="card-text">
                                XXX
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="card text-bg-light">
                        <div class="card-header">
                            <h4>Jumlah Siswa</h4>
                        </div>
                        <div class="card-body">
                            <div class="card-text">
                                XXX
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="card text-bg-primary">
                        <div class="card-header">
                            <h4>Jumlah Soal</h4>
                        </div>
                        <div class="card-body">
                            <div class="card-text">
                                XXX
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="card text-bg-success">
                        <div class="card-header">
                            <h4>Rasio</h4>
                        </div>
                        <div class="card-body">
                            <div class="card-text">
                                XXX
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection