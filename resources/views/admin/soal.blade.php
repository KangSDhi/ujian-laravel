@extends('admin.layouts.layout')

@section('title', $title)

@push('css')
    <style>
        .close-button {
            position: absolute;
            top: 1px;
            right: 1px;
            z-index: 1;
        }
    </style>
@endpush

@section('content')
    <div class="col py-3">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-12 col-sm-6">
                        <h3 class="m-0">{{ $title }}</h3>
                    </div>
                    <div class="col-12 col-sm-6" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                        <ol class="breadcrumb float-end">
                            <li class="breadcrumb-item">
                                <a href="#">Aplikasi Ujian</a>
                            </li>
                            <li class="breadcrumb-item active">
                                {{ $title }}
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <section x-data="dataSoal()" x-init="initData()" class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-8">
                        <div class="row">
                            <template x-for="(item, index) in data">
                                <div class="shadow-lg rounded bg-body w-100 my-2">
                                    <div class="container-fluid my-2">
                                        <div class="row">
                                            <div class="col-11">
                                                <label x-bind:for="'pertanyaan-'+index">Pertanyaan</label>
                                                <textarea x-bind:id="'pertanyaan-'+index" class="form-control" :class="item.pertanyaan_error != null && 'is-invalid'" rows="5" x-model="item.pertanyaan"></textarea>
                                                <span class="invalid-feedback" x-text="item.pertanyaan_error"></span>
                                                <img x-show="item.gambar_pertanyaan != null" class="img-thumbnail my-2"
                                                    style="width: 40rem" :src="item.gambar_pertanyaan_path" alt="">
                                            </div>
                                            <div class="col-1 p-4">
                                                <label x-bind:for="'upload-gambar-pertanyaan-' + index" class="btn btn-primary mb-2">
                                                    <i class="bi bi-card-image"></i>
                                                </label>
                                                <input x-bind:id="'upload-gambar-pertanyaan-' + index" 
                                                    x-on:change="uploadUpdateGambarPertanyaan(index, $event.target.files)"
                                                    type="file" class="d-none">
                                                <button class="btn btn-secondary mb-2">
                                                    <i class="bi bi-eye-fill"></i>
                                                </button>
                                                <button class="btn btn-danger">
                                                    <i class="bi bi-trash3"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-10">
                                                            <label x-bind:for="'pilihan-a-'+index">Pilihan A</label>
                                                            <div class="input-group">
                                                                <input x-bind:id="'pilihan-a-'+index" type="text" class="form-control"
                                                                    :class="item.pilihan_a_error != null && 'is-invalid'"
                                                                    placeholder="Mohon Isi Pilihan A"
                                                                    x-model="item.pilihan_a"
                                                                    :disabled="item.gambar_pilihan_a_path != null">
                                                                <label x-bind:for="'upload-gambar-pilihan-a-' + index"
                                                                    class="btn btn-primary">
                                                                    <i class="bi bi-card-image"></i>
                                                                </label>
                                                                <input x-bind:id="'upload-gambar-pilihan-a-' + index"
                                                                    x-on:change="uploadUpdateGambarPilihan('a', $event.target.files, index)"
                                                                    type="file" class="d-none">
                                                                <span class="invalid-feedback" x-text="item.pilihan_a_error"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-2">
                                                            <label x-bind:for="'nilai-pilihan-a-'+index">Nilai Pil. A</label>
                                                            <input x-bind:id="'nilai-pilihan-a-'+index" type="number" class="form-control"
                                                                :class="item.nilai_a_error != null && 'is-invalid'"
                                                                x-model="item.nilai_a">
                                                            <span class="invalid-feedback" x-text="item.nilai_a_error"></span>
                                                        </div>
                                                    </div>
                                                    <img x-show="item.gambar_pilihan_a_path != null"
                                                        class="img-thumbnail my-2" style="width: 20rem"
                                                        :src="item.gambar_pilihan_a_path" alt="">
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-10">
                                                            <label x-bind:for="'pilihan-b-'+index">Pilihan B</label>
                                                            <div class="input-group">
                                                                <input x-bind:id="'pilihan-b-'+index" type="text" class="form-control"
                                                                    :class="item.pilihan_b_error != null && 'is-invalid'"
                                                                    placeholder="Mohon Isi Pilihan B"
                                                                    x-model="item.pilihan_b"
                                                                    :disabled="item.gambar_pilihan_b_path != null">
                                                                <label x-bind:for="'upload-gambar-pilihan-b-' + index" 
                                                                    class="btn btn-primary">
                                                                    <i class="bi bi-card-image"></i>
                                                                </label>
                                                                <input x-bind:id="'upload-gambar-pilihan-b-' + index"
                                                                    x-on:change="uploadUpdateGambarPilihan('b', $event.target.files, index)"
                                                                    type="file" class="d-none">
                                                                <span class="invalid-feedback" x-text="item.pilihan_b_error"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-2">
                                                            <label x-bind:for="'nilai-pilihan-b-'+index">Nilai Pil. B</label>
                                                            <input x-bind:id="'nilai-pilihan-b-'+index" type="number" class="form-control"
                                                                :class="item.nilai_b_error != null && 'is-invalid'"
                                                                x-model="item.nilai_b">
                                                            <span class="invalid-feedback" x-text="item.nilai_b_error"></span>
                                                        </div>
                                                    </div>
                                                    <img x-show="item.gambar_pilihan_b_path != null"
                                                        class="img-thumbnail my-2" style="width: 20rem"
                                                        :src="item.gambar_pilihan_b_path" alt="">
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-10">
                                                            <label x-bind:for="'pilihan-c-'+index">Pilihan C</label>
                                                            <div class="input-group">
                                                                <input x-bind:id="'pilihan-c-'+index" type="text" class="form-control"
                                                                    :class="item.pilihan_c_error != null && 'is-invalid'"
                                                                    placeholder="Mohon Isi Pilihan C" 
                                                                    x-model="item.pilihan_c"
                                                                    :disabled="item.gambar_pilihan_c_path != null">
                                                                <label x-bind:for="'upload-gambar-pilihan-c-' + index" class="btn btn-primary">
                                                                    <i class="bi bi-card-image"></i>
                                                                </label>
                                                                <input x-bind:id="'upload-gambar-pilihan-c-' + index"
                                                                    x-on:change="uploadUpdateGambarPilihan('c', $event.target.files, index)" 
                                                                    type="file" class="d-none">
                                                                <span class="invalid-feedback" x-text="item.pilihan_c_error"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-2">
                                                            <label x-bind:for="'nilai-pilihan-c'+index">Nilai Pil. C</label>
                                                            <input x-bind:id="'nilai-pilihan-c'+index" type="number" class="form-control"
                                                                :class="item.nilai_c_error != null && 'is-invalid'"
                                                                x-model="item.nilai_c">
                                                            <span class="invalid-feedback" x-text="item.nilai_c_error"></span>
                                                        </div>
                                                    </div>
                                                    <img x-show="item.gambar_pilihan_c_path != null"
                                                        class="img-thumbnail my-2" style="width: 20rem"
                                                        :src="item.gambar_pilihan_c_path" alt="">
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-10">
                                                            <label x-bind:for="'pilihan-d-'+index">Pilihan D</label>
                                                            <div class="input-group">
                                                                <input x-bind:id="'pilihan-d-'+index" type="text" class="form-control"
                                                                    :class="item.pilihan_d_error != null && 'is-invalid'"
                                                                    placeholder="Mohon Isi Pilihan D" 
                                                                    x-model="item.pilihan_d"
                                                                    :disabled="item.gambar_pilihan_d_path != null">
                                                                <label x-bind:for="'upload-gambar-pilihan-d-' + index" 
                                                                    class="btn btn-primary">
                                                                    <i class="bi bi-card-image"></i>
                                                                </label>
                                                                <input x-bind:id="'upload-gambar-pilihan-d-' + index"
                                                                    x-on:change="uploadUpdateGambarPilihan('d', $event.target.files, index)" 
                                                                    type="file" class="d-none">
                                                                <span class="invalid-feedback" x-text="item.pilihan_d_error"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-2">
                                                            <label x-bind:for="'nilai-pilihan-d-'+index">Nilai Pil. D</label>
                                                            <input x-bind:id="'nilai-pilihan-d-'+index" type="number" class="form-control"
                                                                :class="item.nilai_d_error != null && 'is-invalid'"
                                                                x-model="item.nilai_d">
                                                            <span class="invalid-feedback" x-text="item.nilai_d_error"></span>
                                                        </div>
                                                    </div>
                                                    <img x-show="item.gambar_pilihan_d_path != null"
                                                        class="img-thumbnail my-2" style="width: 20rem"
                                                        :src="item.gambar_pilihan_d_path" alt="">
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-10">
                                                            <label x-bind:for="'pilihan-e-'+index">Pilihan E</label>
                                                            <div class="input-group">
                                                                <input x-bind:id="'pilihan-e-'+index" type="text" class="form-control"
                                                                    :class="item.pilihan_e_error != null && 'is-invalid'"
                                                                    placeholder="Mohon Isi Pilihan E" 
                                                                    x-model="item.pilihan_e"
                                                                    :disabled="item.gambar_pilihan_e_path != null">
                                                                <label x-bind:for="'upload-gambar-pilihan-e-' + index" 
                                                                    class="btn btn-primary">
                                                                    <i class="bi bi-card-image"></i>
                                                                </label>
                                                                <input x-bind:id="'upload-gambar-pilihan-e-' + index" 
                                                                    x-on:change="uploadUpdateGambarPilihan('e', $event.target.files, index)"
                                                                    type="file" class="d-none">
                                                                <span class="invalid-feedback" x-text="item.pilihan_e_error"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-2">
                                                            <label x-bind:for="'nilai-pilihan-e-'+index">Nilai Pil. E</label>
                                                            <input x-bind:id="'nilai-pilihan-e-'+index" type="number" class="form-control"
                                                                :class="item.nilai_e_error != null && 'is-invalid'"
                                                                x-model="item.nilai_e">
                                                            <span class="invalid-feedback" x-text="item.nilai_e_error"></span>
                                                        </div>
                                                    </div>
                                                    <img x-show="item.gambar_pilihan_e_path != null"
                                                        class="img-thumbnail my-2" style="width: 20rem"
                                                        :src="item.gambar_pilihan_e_path" alt="">
                                                </div>
                                                <div class="d-flex my-2 justify-content-end">
                                                    <button class="btn btn-primary" @click="updateSoal(data[index], index)">
                                                        <i class="bi bi-pencil-square"></i>
                                                        Ubah
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>
                        <div class="row" x-show="showFormTambahSoal">
                            <div class="shadow-lg rounded bg-body w-100 my-2">
                                <div class="container-fluid my-2">
                                    <div class="row">
                                        <div class="col-11">
                                            <label for="pertanyaan">Pertanyaan</label>
                                            <textarea id="pertanyaan" class="form-control" :class="dataTambahSoal.pertanyaan_error != null && 'is-invalid'" rows="5"
                                                x-model="dataTambahSoal.pertanyaan"></textarea>
                                            <span class="invalid-feedback"
                                                x-text="dataTambahSoal.pertanyaan_error"></span>

                                            <template x-if="dataTambahSoal.gambar_pertanyaan != null">
                                                <div class="d-flex align-items-start py-2">
                                                    <img class="img-thumbnail"
                                                    style="width: 40rem" :src="dataTambahSoal.gambar_pertanyaan_path"
                                                    alt="">
                                                    <button class="btn btn-danger mx-2" @click="hapusGambarTambahSoal('pertanyaan')">
                                                        <i class="bi bi-trash3"></i>
                                                    </button>
                                                </div>
                                            </template>

                                        </div>
                                        <div class="col-1 p-4">
                                            <label for="upload-gambar-pertanyaan" class="btn btn-primary mb-2">
                                                <i class="bi bi-card-image"></i>
                                            </label>
                                            <input id="upload-gambar-pertanyaan"
                                                x-on:change="uploadGambarPertanyaan($event.target.files)" type="file"
                                                class="d-none">
                                            <button class="btn btn-secondary mb-2">
                                                <i class="bi bi-eye-fill"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-10">
                                                        <label for="pilihan-a">Pilihan A</label>
                                                        <div class="input-group">
                                                            <input id="pilihan-a" type="text" class="form-control"
                                                                :class="dataTambahSoal.pilihan_a_error != null && 'is-invalid'"
                                                                placeholder="Mohon Isi Pilihan A"
                                                                x-model="dataTambahSoal.pilihan_a"
                                                                :disabled="dataTambahSoal.gambar_pilihan_a_path != null">
                                                            <label for="upload-gambar-pilihan-a" class="btn btn-primary">
                                                                <i class="bi bi-card-image"></i>
                                                            </label>
                                                            <input id="upload-gambar-pilihan-a"
                                                                x-on:change="uploadGambarPilihan('a', $event.target.files)"
                                                                type="file" class="d-none">
                                                            <span class="invalid-feedback"
                                                                x-text="dataTambahSoal.pilihan_a_error"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-2">
                                                        <label for="nilai-pilihan-a">Nilai Pil. A</label>
                                                        <input id="nilai-pilihan-a" type="number" class="form-control"
                                                            :class="dataTambahSoal.nilai_a_error != null && 'is-invalid'"
                                                            x-model="dataTambahSoal.nilai_a">
                                                        <span class="invalid-feedback"
                                                            x-text="dataTambahSoal.nilai_a_error"></span>
                                                    </div>
                                                </div>

                                                <template x-if="dataTambahSoal.gambar_pilihan_a_path != null">
                                                    <div class="d-flex align-items-start py-2">
                                                        <img class="img-thumbnail" style="width: 20rem"
                                                        :src="dataTambahSoal.gambar_pilihan_a_path" alt="">
                                                        <button class="btn btn-danger mx-2" @click="hapusGambarTambahSoal('pilihan-a')">
                                                            <i class="bi bi-trash3"></i>
                                                        </button>
                                                    </div>
                                                </template>
                                                
                                                
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-10">
                                                        <label for="pilihan-b">Pilihan B</label>
                                                        <div class="input-group">
                                                            <input id="pilihan-b" type="text" class="form-control"
                                                                :class="dataTambahSoal.pilihan_b_error != null && 'is-invalid'"
                                                                placeholder="Mohon Isi Pilihan B"
                                                                x-model="dataTambahSoal.pilihan_b"
                                                                :disabled="dataTambahSoal.gambar_pilihan_b_path != null">
                                                            <label for="upload-gambar-pilihan-b" class="btn btn-primary">
                                                                <i class="bi bi-card-image"></i>
                                                            </label>
                                                            <input id="upload-gambar-pilihan-b"
                                                                x-on:change="uploadGambarPilihan('b', $event.target.files)"
                                                                type="file" class="d-none">
                                                            <span class="invalid-feedback"
                                                                x-text="dataTambahSoal.pilihan_b_error"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-2">
                                                        <label for="nilai-pilihan-b">Nilai Pil. B</label>
                                                        <input id="nilai-pilihan-b" type="number" class="form-control"
                                                            :class="dataTambahSoal.nilai_b_error != null && 'is-invalid'"
                                                            x-model="dataTambahSoal.nilai_b">
                                                        <span class="invalid-feedback"
                                                            x-text="dataTambahSoal.nilai_b_error"></span>
                                                    </div>
                                                </div>

                                                <template x-if="dataTambahSoal.gambar_pilihan_b_path != null">
                                                    <div class="d-flex align-items-start py-2">
                                                        <img class="img-thumbnail" style="width: 20rem"
                                                        :src="dataTambahSoal.gambar_pilihan_b_path" alt="">
                                                        <button class="btn btn-danger mx-2" @click="hapusGambarTambahSoal('pilihan-b')">
                                                            <i class="bi bi-trash3"></i>
                                                        </button>
                                                    </div>
                                                </template>
                                                
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-10">
                                                        <label for="pilihan-c">Pilihan C</label>
                                                        <div class="input-group">
                                                            <input id="pilihan-c" type="text" class="form-control"
                                                                :class="dataTambahSoal.pilihan_c_error != null && 'is-invalid'"
                                                                placeholder="Mohon Isi Pilihan C"
                                                                x-model="dataTambahSoal.pilihan_c"
                                                                :disabled="dataTambahSoal.gambar_pilihan_c_path != null">
                                                            <label for="upload-gambar-pilihan-c" class="btn btn-primary">
                                                                <i class="bi bi-card-image"></i>
                                                            </label>
                                                            <input id="upload-gambar-pilihan-c"
                                                                x-on:change="uploadGambarPilihan('c', $event.target.files)"
                                                                type="file" class="d-none">
                                                            <span class="invalid-feedback"
                                                                x-text="dataTambahSoal.pilihan_c_error"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-2">
                                                        <label for="nilai-pilihan-c">Nilai Pil. C</label>
                                                        <input id="nilai-pilihan-c" type="number" class="form-control"
                                                            :class="dataTambahSoal.nilai_c_error != null && 'is-invalid'"
                                                            x-model="dataTambahSoal.nilai_c">
                                                        <span class="invalid-feedback"
                                                            x-text="dataTambahSoal.nilai_c_error"></span>
                                                    </div>
                                                </div>

                                                <template x-if="dataTambahSoal.gambar_pilihan_c_path != null">
                                                    <div class="d-flex align-items-start py-2">
                                                        <img class="img-thumbnail" style="width: 20rem"
                                                        :src="dataTambahSoal.gambar_pilihan_c_path" alt="">
                                                        <button class="btn btn-danger mx-2" @click="hapusGambarTambahSoal('pilihan-c')">
                                                            <i class="bi bi-trash3"></i>
                                                        </button>
                                                    </div>
                                                </template>
                                                
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-10">
                                                        <label for="pilihan-d">Pilihan D</label>
                                                        <div class="input-group">
                                                            <input id="pilihan-d" type="text" class="form-control"
                                                                :class="dataTambahSoal.pilihan_d_error != null && 'is-invalid'"
                                                                placeholder="Mohon Isi Pilihan D"
                                                                x-model="dataTambahSoal.pilihan_d"
                                                                :disabled="dataTambahSoal.gambar_pilihan_d_path != null">
                                                            <label for="upload-gambar-pilihan-d" class="btn btn-primary">
                                                                <i class="bi bi-card-image"></i>
                                                            </label>
                                                            <input id="upload-gambar-pilihan-d"
                                                                x-on:change="uploadGambarPilihan('d', $event.target.files)"
                                                                type="file" class="d-none">
                                                            <span class="invalid-feedback"
                                                                x-text="dataTambahSoal.pilihan_d_error"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-2">
                                                        <label for="nilai-pilihan-d">Nilai Pil. D</label>
                                                        <input id="nilai-pilihan-d" type="number" class="form-control"
                                                            :class="dataTambahSoal.nilai_d_error != null && 'is-invalid'"
                                                            x-model="dataTambahSoal.nilai_d">
                                                        <span class="invalid-feedback"
                                                            x-text="dataTambahSoal.nilai_d_error"></span>
                                                    </div>
                                                </div>

                                                <template x-if="dataTambahSoal.gambar_pilihan_d_path != null">
                                                    <div class="d-flex align-items-start py-2">
                                                        <img class="img-thumbnail" style="width: 20rem"
                                                        :src="dataTambahSoal.gambar_pilihan_d_path" alt="">
                                                        <button class="btn btn-danger mx-2" @click="hapusGambarTambahSoal('pilihan-d')">
                                                            <i class="bi bi-trash3"></i>
                                                        </button>
                                                    </div>
                                                </template>

                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-10">
                                                        <label for="pilihan-e">Pilihan E</label>
                                                        <div class="input-group">
                                                            <input id="pilihan-e" type="text" class="form-control"
                                                                :class="dataTambahSoal.pilihan_e_error != null && 'is-invalid'"
                                                                placeholder="Mohon Isi Pilihan E"
                                                                x-model="dataTambahSoal.pilihan_e"
                                                                :disabled="dataTambahSoal.gambar_pilihan_e_path != null">
                                                            <label for="upload-gambar-pilihan-e" class="btn btn-primary">
                                                                <i class="bi bi-card-image"></i>
                                                            </label>
                                                            <input id="upload-gambar-pilihan-e"
                                                                x-on:change="uploadGambarPilihan('e', $event.target.files)"
                                                                type="file" class="d-none">
                                                            <span class="invalid-feedback"
                                                                x-text="dataTambahSoal.pilihan_e_error"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-2">
                                                        <label for="nilai-pilihan-e">Nilai Pil. E</label>
                                                        <input id="nilai-pilihan-e" type="number" class="form-control"
                                                            :class="dataTambahSoal.nilai_e_error != null && 'is-invalid'"
                                                            x-model="dataTambahSoal.nilai_e">
                                                        <span class="invalid-feedback"
                                                            x-text="dataTambahSoal.nilai_e_error"></span>
                                                    </div>
                                                </div>

                                                <template x-if="dataTambahSoal.gambar_pilihan_e_path != null">
                                                    <div class="d-flex align-items-start py-2">
                                                        <img class="img-thumbnail" style="width: 20rem"
                                                        :src="dataTambahSoal.gambar_pilihan_e_path" alt="">
                                                        <button class="btn btn-danger mx-2" @click="hapusGambarTambahSoal('pilihan-e')">
                                                            <i class="bi bi-trash3"></i>
                                                        </button>
                                                    </div>
                                                </template>
                                                
                                            </div>
                                            <div class="d-flex my-2 justify-content-end">
                                                <button class="btn btn-primary" @click="tambahSoal()">
                                                    <i class="bi bi-plus-circle-fill"></i>
                                                    Tambah
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="d-grid">
                                <button class="btn btn-primary" @click="showFormTambahSoal = true">
                                    <i class="bi bi-plus-square-dotted"></i>
                                    Tambah Soal
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('script')
    <script>
        const dataSoal = () => {
            return {
                token: localStorage.getItem('token'),
                data: [],
                idSoal: '{{ $idSoal }}',
                showFormTambahSoal: false,
                dataTambahSoal: {

                    pertanyaan: null,
                    pertanyaan_error: null,
                    gambar_pertanyaan: null,
                    gambar_pertanyaan_path: null,
                    
                    gambar_pilihan_a_path: null,
                    pilihan_a: null,
                    pilihan_a_error: null,
                    
                    gambar_pilihan_b_path: null,
                    pilihan_b: null,
                    pilihan_b_error: null,

                    gambar_pilihan_c_path: null,
                    pilihan_c: null,
                    pilihan_c_error: null,
                    
                    gambar_pilihan_d_path: null,
                    pilihan_d: null,
                    pilihan_d_error: null,

                    gambar_pilihan_e_path: null,
                    pilihan_e: null,
                    pilihan_e_error: null,

                    nilai_a: 0,
                    nilai_a_error: null,
                    nilai_b: 0,
                    nilai_b_error: null,
                    nilai_c: 0,
                    nilai_c_error: null,
                    nilai_d: 0,
                    nilai_d_error: null,
                    nilai_e: 0,
                    nilai_e_error: null,
                },
                initData() {
                    axios.post('{{ route('admin.post.soal.in.banksoal') }}', {
                            idSoal: this.idSoal
                        }, {
                            headers: {
                                'Authorization': 'Bearer ' + this.token
                            }
                        })
                        .then(({
                            data
                        }) => {
                            console.log(data);
                            this.data = data;
                        })
                        .catch(({
                            response
                        }) => {
                            console.error(response);
                        });
                },
                tambahSoal() {
                    console.log(this.dataTambahSoal);
                    axios.post('{{ route('admin.post.soal.bank.store') }}', {
                            id_soal: this.idSoal,
                            tipe_soal: 'pilihan_ganda',
                            pertanyaan: this.dataTambahSoal.pertanyaan,
                            gambar_pertanyaan: this.dataTambahSoal.gambar_pertanyaan,
                            pilihan_a: this.dataTambahSoal.pilihan_a,
                            pilihan_b: this.dataTambahSoal.pilihan_b,
                            pilihan_c: this.dataTambahSoal.pilihan_c,
                            pilihan_d: this.dataTambahSoal.pilihan_d,
                            pilihan_e: this.dataTambahSoal.pilihan_e,
                            nilai_a: this.dataTambahSoal.nilai_a,
                            nilai_b: this.dataTambahSoal.nilai_b,
                            nilai_c: this.dataTambahSoal.nilai_c,
                            nilai_d: this.dataTambahSoal.nilai_d,
                            nilai_e: this.dataTambahSoal.nilai_e
                        }, {
                            headers: {
                                'Authorization': 'Bearer ' + this.token
                            }
                        })
                        .then(({
                            data
                        }) => {
                            console.log(data);
                            window.location.href = "{{ url('admin/soal/bank/') }}" + "/" + this.idSoal + "?token=" + this.token;
                        })
                        .catch(({
                            response
                        }) => {
                            console.error(response);
                            if (response.status == 422) {

                                this.resetErrorMessageTambahSoal();

                                Object.keys(response.data).forEach(key => {
                                    if (response.data[key] != null) {
                                        this.dataTambahSoal[key + '_error'] = response.data[key][0];
                                    }
                                });
                            }
                        });
                },
                updateSoal(data, index){
                    console.table(data);
                    console.log(index);
                    axios.post('{{ route('admin.post.soal.bank.update') }}', {
                        id: data.id,
                        soal_id: data.soal_id,
                        tipe: data.tipe,
                        gambar_pertanyaan: data.gambar_pertanyaan,
                        pertanyaan: data.pertanyaan,
                        pilihan_a: data.pilihan_a,
                        pilihan_b: data.pilihan_b,
                        pilihan_c: data.pilihan_c,
                        pilihan_d: data.pilihan_d,
                        pilihan_e: data.pilihan_e,
                        nilai_a: data.nilai_a,
                        nilai_b: data.nilai_b,
                        nilai_c: data.nilai_c,
                        nilai_d: data.nilai_d,
                        nilai_e: data.nilai_e,
                    }, {
                        headers: {
                            'Authorization': 'Bearer ' + this.token
                        }
                    })
                    .then(({ data }) => {
                        console.log(data);
                    })
                    .catch(({ response }) => {
                        if (response.status == 422) {
                            console.error(response);  
                            this.resetErrorMessageUpdateSoal(index); 
                            Object.keys(response.data).forEach(key => {
                                if (response.data[key] != null) {
                                    this.data[index][key + '_error'] = response.data[key][0]; 
                                }
                            });
                        }
                    });
                },
                resetErrorMessageTambahSoal() {
                    this.dataTambahSoal.pertanyaan_error = null;
                    this.dataTambahSoal.pilihan_a_error = null;
                    this.dataTambahSoal.pilihan_b_error = null;
                    this.dataTambahSoal.pilihan_c_error = null;
                    this.dataTambahSoal.pilihan_d_error = null;
                    this.dataTambahSoal.pilihan_e_error = null;
                    this.dataTambahSoal.nilai_a_error = null;
                    this.dataTambahSoal.nilai_b_error = null;
                    this.dataTambahSoal.nilai_c_error = null;
                    this.dataTambahSoal.nilai_d_error = null;
                    this.dataTambahSoal.nilai_e_error = null;
                },
                resetErrorMessageUpdateSoal(index){
                    this.data[index].pertanyaan_error = null;
                    this.data[index].pilihan_a_error = null;
                    this.data[index].pilihan_b_error = null;
                    this.data[index].pilihan_c_error = null;
                    this.data[index].pilihan_d_error = null;
                    this.data[index].pilihan_e_error = null;
                    this.data[index].nilai_a_error = null;
                    this.data[index].nilai_b_error = null;
                    this.data[index].nilai_c_error = null;
                    this.data[index].nilai_d_error = null;
                    this.data[index].nilai_e_error = null;
                },
                uploadGambarPertanyaan(file) {
                    const formData = new FormData();
                    formData.append('gambar_pertanyaan', file[0]);
                    axios.post('{{ route('admin.post.soal.bank.upload.gambar.pertanyaan') }}', formData, {
                            headers: {
                                'Authorization': 'Bearer ' + this.token
                            }
                        })
                        .then(({
                            data
                        }) => {
                            console.log(data.data.url);
                            this.dataTambahSoal.gambar_pertanyaan_show = true;
                            this.dataTambahSoal.gambar_pertanyaan = data.data.path;
                            this.dataTambahSoal.gambar_pertanyaan_path = data.data.url;
                        })
                        .catch((error) => {
                            console.error(error);
                        });
                },
                uploadGambarPilihan(pilihan, file) {
                    console.log(pilihan);
                    console.log(file);
                    const formData = new FormData();
                    formData.append('gambar_pilihan', file[0]);
                    axios.post('{{ route('admin.post.soal.bank.upload.gambar.pilihan') }}', formData, {
                            headers: {
                                'Authorization': 'Bearer ' + this.token
                            }
                        })
                        .then(({
                            data
                        }) => {
                            console.log(data.data);
                            if (pilihan == 'a') {
                                this.dataTambahSoal.gambar_pilihan_a_path = data.data.url;
                                this.dataTambahSoal.pilihan_a = data.data.path;
                            } else if (pilihan == 'b') {
                                this.dataTambahSoal.gambar_pilihan_b_path = data.data.url;
                                this.dataTambahSoal.pilihan_b = data.data.path;
                            } else if (pilihan == 'c') {
                                this.dataTambahSoal.gambar_pilihan_c_path = data.data.url;
                                this.dataTambahSoal.pilihan_c = data.data.path;
                            } else if (pilihan == 'd') {
                                this.dataTambahSoal.gambar_pilihan_d_path = data.data.url;
                                this.dataTambahSoal.pilihan_d = data.data.path;
                            } else if (pilihan == 'e') {
                                this.dataTambahSoal.gambar_pilihan_e_path = data.data.url;
                                this.dataTambahSoal.pilihan_e = data.data.path;
                            }
                        })
                        .catch((error) => {
                            console.log(error);
                        });
                },
                uploadUpdateGambarPertanyaan(index, file){
                    const formData = new FormData();
                    formData.append('gambar_pertanyaan', file[0]);
                    axios.post('{{ route('admin.post.soal.bank.upload.gambar.pertanyaan') }}', formData, {
                            headers: {
                                'Authorization': 'Bearer ' + this.token
                            }
                        })
                        .then(({
                            data
                        }) => {
                            console.log(data.data.url);
                            this.data[index].gambar_pertanyaan = data.data.path;
                            this.data[index].gambar_pertanyaan_path = data.data.url;
                        })
                        .catch((error) => {
                            console.error(error);
                        });
                },
                uploadUpdateGambarPilihan(pilihan, file, index) {
                    console.log(pilihan);
                    console.log(file);
                    console.log(index);
                    console.log(this.data[index]);
                    const formData = new FormData();
                    formData.append('gambar_pilihan', file[0]);
                    axios.post('{{ route('admin.post.soal.bank.upload.gambar.pilihan') }}', formData, {
                            headers: {
                                'Authorization': 'Bearer ' + this.token
                            }
                        })
                        .then(({
                            data
                        }) => {
                            console.log(data);
                            if (pilihan == 'a') {
                                this.data[index].pilihan_a = data.data.path;
                                this.data[index].gambar_pilihan_a_path = data.data.url;
                            } else if(pilihan == 'b'){
                                this.data[index].pilihan_b = data.data.path;
                                this.data[index].gambar_pilihan_b_path = data.data.url;
                            } else if(pilihan == 'c'){
                                this.data[index].pilihan_c = data.data.path;
                                this.data[index].gambar_pilihan_c_path = data.data.url;
                            } else if(pilihan == 'd'){
                                this.data[index].pilihan_d = data.data.path;
                                this.data[index].gambar_pilihan_d_path = data.data.url;
                            } else if(pilihan == 'e'){
                                this.data[index].pilihan_e = data.data.path;
                                this.data[index].gambar_pilihan_e_path = data.data.url;
                            }
                        })
                        .catch((error) => {
                            console.error(error);
                        });
                },
                hapusGambarTambahSoal(elemen){
                    if (elemen == 'pertanyaan') {
                        this.dataTambahSoal.gambar_pertanyaan = null;
                        this.dataTambahSoal.gambar_pertanyaan_path = null;
                    }else if(elemen == 'pilihan-a'){
                        this.dataTambahSoal.pilihan_a = null;
                        this.dataTambahSoal.gambar_pilihan_a_path = null;
                    }else if(elemen == 'pilihan-b'){
                        this.dataTambahSoal.pilihan_b = null;
                        this.dataTambahSoal.gambar_pilihan_b_path = null;
                    }else if(elemen == 'pilihan-c'){
                        this.dataTambahSoal.pilihan_c = null;
                        this.dataTambahSoal.gambar_pilihan_c_path = null;
                    }else if(elemen == 'pilihan-d'){
                        this.dataTambahSoal.pilihan_d = null;
                        this.dataTambahSoal.gambar_pilihan_d_path = null;
                    }else if(elemen == 'pilihan-e'){
                        this.dataTambahSoal.pilihan_e = null;
                        this.dataTambahSoal.gambar_pilihan_e_path = null;
                    }
                }
            }
        }
    </script>
@endpush
