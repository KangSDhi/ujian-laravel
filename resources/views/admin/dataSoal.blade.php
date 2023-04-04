@extends('admin.layouts.layout')

@section('title', $title)

@section('content')
    <div class="col py-3">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-12 col-sm-6">
                        <h1 class="m-0">Data Soal</h1>
                    </div>
                    <div class="col-12 col-sm-6" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                        <ol class="breadcrumb float-end">
                            <li class="breadcrumb-item">
                                <a href="#">Aplikasi Ujian</a>
                            </li>
                            <li class="breadcrumb-item active">
                                Data Soal
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div x-data="dataTable()" x-init="initData()" class="col-12 col-sm-12 col-md-12">
                        <div class="card shadow">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex gap-2 align-items-center">
                                        <div class="align-self-center">Show</div>
                                        <select class="form-select form-select-sm align-self-center">
                                            <option value="X">X</option>
                                        </select>
                                    </div>
                                    <div>
                                        <input type="search" class="form-control" placeholder="Cari..">
                                    </div>
                                </div>
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nama Soal</th>
                                            <th scope="col">Butir Soal</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                                <div class="pagination">
                                    <div class="page-item">
                                        <span class="page-link" role="button">Awal</span>
                                    </div>
                                    <div class="page-item">
                                        <span class="page-link" role="button">
                                            < </span>
                                    </div>
                                    <div class="page-item">
                                        <span class="page-link" role="button">
                                            >
                                        </span>
                                    </div>
                                    <div class="page-item">
                                        <span class="page-link" role="button">Akhir</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('script')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"
        integrity="sha256-EIyuZ2Lbxr6vgKrEt8W2waS6D3ReLf9aeoYPZ/maJPI=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/fuse.js/dist/fuse.js"></script>
    <script>
        window.dataTable = function() {
            return {
                token: localStorage.getItem('token'),
                initData() {
                    const token = this.token;
                    async function fetchData() {
                        try {
                            const {data} = await axios.post('{{ route('admin.post.data.soal') }}', {}, {
                                headers: {
                                    'Authorization': 'Bearer ' + token
                                }
                            });
                            return data.data;
                        } catch (error) {
                            return error;
                        }
                    }

                    fetchData()
                    .then(data => {
                        console.log(data);
                    })
                    .catch(error => {
                        console.error(error);
                    });
                },
            }
        }
    </script>
@endpush
