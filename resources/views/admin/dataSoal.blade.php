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
                                        <select x-model="view" @change="changeView()" class="form-select form-select-sm align-self-center">
                                            <template x-for="(item, index) in listViewBinding()">
                                                <option x-bind:value="item" x-text="item"></option>
                                            </template>
                                        </select>
                                    </div>
                                    <div>
                                        <input x-model="searchInput" x-init="$watch('searchInput', value => { search(value) })" type="search" class="form-control" placeholder="Cari..">
                                    </div>
                                </div>
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">
                                                <div class="d-flex gap-1">
                                                    <span>Nama Soal</span>
                                                    <div class="d-flex flex-column">
                                                        <svg @click="sort('nama_soal', 'asc')" fill="none" fill="none"
                                                            stroke-linecap="round" stroke-linejoin="round" stroke-width="4"
                                                            viewBox="0 0 24 24" stroke="currentColor" width="12px"
                                                            height="12px"
                                                            x-bind:class="{ 'text-primary': sorted.field === 'nama_soal' && sorted.rule === 'asc' }">
                                                            <path d="M5 15l7-7 7 7"></path>
                                                        </svg>
                                                        <svg @click="sort('nama_soal', 'desc')" fill="none"
                                                            stroke-linecap="round" stroke-linejoin="round" stroke-width="4"
                                                            viewBox="0 0 24 24" stroke="currentColor" width="12px"
                                                            height="12px"
                                                            x-bind:class="{ 'text-primary': sorted.field === 'nama_soal' && sorted.rule === 'desc' }">
                                                            <path d="M19 9l-7 7-7-7"></path>
                                                        </svg>
                                                    </div>
                                                </div>
                                            </th>
                                            <th scope="col">
                                                <div class="d-flex gap-1">
                                                    <span>Butir Soal</span>
                                                    <div class="d-flex flex-column">
                                                        <svg @click="sort('butir_soal', 'asc')" fill="none" fill="none"
                                                            stroke-linecap="round" stroke-linejoin="round" stroke-width="4"
                                                            viewBox="0 0 24 24" stroke="currentColor" width="12px"
                                                            height="12px"
                                                            x-bind:class="{ 'text-primary': sorted.field === 'butir_soal' && sorted.rule === 'asc' }">
                                                            <path d="M5 15l7-7 7 7"></path>
                                                        </svg>
                                                        <svg @click="sort('butir_soal', 'desc')" fill="none"
                                                            stroke-linecap="round" stroke-linejoin="round" stroke-width="4"
                                                            viewBox="0 0 24 24" stroke="currentColor" width="12px"
                                                            height="12px"
                                                            x-bind:class="{ 'text-primary': sorted.field === 'butir_soal' && sorted.rule === 'desc' }">
                                                            <path d="M19 9l-7 7-7-7"></path>
                                                        </svg>
                                                    </div>
                                                </div>
                                            </th>
                                            <th scoppe="col">
                                                <div class="d-flex gap-1">
                                                    <span>Acak</span>
                                                    <div class="d-flex flex-column">
                                                        <svg @click="sort('acak', 'desc')" fill="none" fill="none"
                                                            stroke-linecap="round" stroke-linejoin="round" stroke-width="4"
                                                            viewBox="0 0 24 24" stroke="currentColor" width="12px"
                                                            height="12px"
                                                            x-bind:class="{ 'text-primary': sorted.field === 'acak' && sorted.rule === 'desc' }">
                                                            <path d="M5 15l7-7 7 7"></path>
                                                        </svg>
                                                        <svg @click="sort('acak', 'asc')" fill="none"
                                                            stroke-linecap="round" stroke-linejoin="round" stroke-width="4"
                                                            viewBox="0 0 24 24" stroke="currentColor" width="12px"
                                                            height="12px"
                                                            x-bind:class="{ 'text-primary': sorted.field === 'acak' && sorted.rule === 'asc' }">
                                                            <path d="M19 9l-7 7-7-7"></path>
                                                        </svg>
                                                    </div>
                                                </div>
                                            </th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <template x-for="(item, index) in items">
                                            <tr x-show="checkView(index + 1)">
                                                <td x-text="index + 1"></td>
                                                <td x-text="item.nama_soal"></td>
                                                <td x-text="item.butir_soal"></td>
                                                <template x-if="item.acak == 1">
                                                    <td>Acak</td>
                                                </template>
                                                <template x-if="item.acak == 0">
                                                    <td>Tidak Acak</td>
                                                </template>
                                                <td x-data="{ button: '<a href=\'#?token='+token+'\' class=\'btn btn-info mx-2\'>Edit</a><a href=\'#?token='+token+'\' class=\'btn btn-danger\'>Hapus</a>'  }">
                                                    <span x-html="button"></span>
                                                </td>
                                            </tr>
                                        </template>
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex">
                                        <div class="pagination">
                                            <div class="page-item" @click="clickPage(1)">
                                                <span class="page-link" role="button">Awal</span>
                                            </div>
                                            <div class="page-item" @click="clickPage(pagination.currentPage - 1)">
                                                <span class="page-link" role="button">
                                                    < </span>
                                            </div>
                                            <template x-for="(item, index) in pagination.pages">
                                                <div class="page-item" @click="clickPage(item)">
                                                    <span class="page-link" :class="{ 'bg-info text-dark': pagination.currentPage === item }" role="button" x-text="item">
                                                    </span>
                                                </div>
                                            </template>
                                            <div class="page-item" @click="clickPage(pagination.currentPage + 1)">
                                                <span class="page-link" role="button">
                                                    >
                                                </span>
                                            </div>
                                            <div class="page-item" @click="clickPage(pagination.lastPage)">
                                                <span class="page-link" role="button">Akhir</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center badge bg-primary">
                                        <span>Total : <span x-text="pagination.total"></span></span>
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
    <script src="https://cdn.jsdelivr.net/npm/fuse.js/dist/fuse.js"></script>
    <script>
        const dataTable = () => {
            return {
                token: localStorage.getItem('token'),
                data: [],
                items: [],
                listView: [10, 25, 50, 100],
                view: 10,
                searchInput: "",
                pagination: {
                    pages: [],
                    currentPage: 1,
                    offset: 5,
                    lastPage: 0,
                    from: 1,
                    to: 10,
                    total: 0,
                },
                sorted: {
                    field: 'nama_soal',
                    rule: 'asc'
                },
                initData() {
                    const token = this.token;
                    async function fetchData() {
                        try {
                            const {
                                data
                            } = await axios.post('{{ route('admin.post.data.soal') }}', {}, {
                                headers: {
                                    'Authorization': 'Bearer ' + token
                                }
                            });
                            return data.data;
                        } catch (error) {
                            return error;
                        }
                    }

                    fetchData().then(data => {
                        this.items = this.data = data;
                        this.pagination.lastPage = Math.ceil(data.length / this.view);
                        this.pagination.total = data.length;
                        
                        this.showPages();
                    })
                    .catch(error => {
                        console.error(error);
                    });
                },
                checkView(index){
                    return index > this.pagination.to || index < this.pagination.from ? false : true;
                },
                showPages(){
                    const pages = [];

                    let from = this.pagination.currentPage - Math.ceil(this.pagination.offset / 2);

                    if (from < 1) {
                        from = 1;
                    }

                    let to = from + this.pagination.offset - 1;
                    if (to > this.pagination.lastPage) {
                        to = this.pagination.lastPage;
                    }

                    while(from <= to){
                        pages.push(from);
                        from++;
                    }

                    this.pagination.pages = pages;
                },
                changePage(page){
                    if (page >= 1 && page <= this.pagination.lastPage) {
                        this.showPages();
                        const total = this.items.length;
                        const lastPage = Math.ceil(total / this.view) || 1; // check
                        const from = (page - 1) * this.view + 1;
                        let to = page * this.view;
                        if (page === lastPage) {
                            to = total; 
                        }

                        this.pagination.lastPage = lastPage;
                        this.pagination.currentPage = page;
                        this.pagination.from = from;
                        this.pagination.to = to;
                    }
                },
                clickPage(page){
                    this.changePage(page);
                    this.showPages();
                },
                changeView(){
                    this.changePage(1);
                    this.showPages();
                },
                sort(field, rule){
                    this.items = this.items.sort(this.compareOnKey(field, rule));
                    this.sorted.field = field;
                    this.sorted.rule = rule;
                },
                compareOnKey(key, rule){
                    console.log(key);
                    return function(a, b){
                        if (key == 'nama_soal') {
                            let comparison = 0;
                            const fieldA = a[key].toUpperCase();
                            const fieldB = b[key].toUpperCase();
                            if (rule === 'asc') {
                                if (fieldA > fieldB) {
                                    comparison = 1;
                                } else if (fieldA < fieldB) {
                                    comparison = -1;
                                }
                            } else {
                                if (fieldA < fieldB) {
                                    comparison = 1;
                                } else if (fieldA > fieldB){
                                    comparison = -1;
                                }
                            }
                            return comparison;
                        } else if (key == 'butir_soal' || key == 'acak'){
                            if (rule == 'asc') {
                                return a[key] - b[key];
                            } else {
                                return b[key] - a[key];
                            }
                        }
                    }
                },
                listViewBinding(){
                    let list = [];
                    for (let index = 0; index < this.listView.length; index++) {
                        if (this.listView[index] < this.items.length) {
                            list.push(this.listView[index]);
                        }
                    }

                    const listLength = parseInt(JSON.stringify(this.items.length))

                    list.push(listLength);
                    return list;
                },
                search(value){
                    if (value.length >= 1) {
                        const options = {
                            shouldSort: true,
                            keys: ['nama_soal'],
                            threshold: 0
                        };
                        const fuse = new Fuse(this.data, options);
                        this.items = fuse.search(value).map(elem => elem.item);
                    } else {
                        this.items = this.data;
                    }
                }
            }
        }
    </script>
@endpush
