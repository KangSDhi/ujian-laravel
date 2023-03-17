@extends('admin.layouts.layout')

@section('title', $title)

@push('css')
@endpush

@section('content')
    <div class="col py-3">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-12 col-sm-6">
                        <h1 class="m-0">Data Guru</h1>
                    </div>
                    <div class="col-12 col-sm-6" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                        <ol class="breadcrumb float-end">
                            <li class="breadcrumb-item">
                                <a href="#">Aplikasi Ujian</a>
                            </li>
                            <li class="breadcrumb-item active">
                                Data Guru
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
                                        <select x-model="view" @change="changeView()"
                                            class="form-select form-select-sm align-self-center">
                                            <template x-for="(item, index) in listView" :key="index">
                                                <option :value="item" x-text="item"></option>
                                            </template>
                                            
                                        </select>
                                    </div>
                                    <div>
                                        <input x-model="searchInput" x-init="$watch('searchInput', value => { search(value) })" type="text"
                                            class="form-control" placeholder="Cari....">
                                    </div>
                                </div>
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">
                                                <div class="d-flex gap-1">
                                                    <span>Name</span>
                                                    <div class="d-flex flex-column">
                                                        <svg @click="sort('name', 'asc')" fill="none" fill="none"
                                                            stroke-linecap="round" stroke-linejoin="round" stroke-width="4"
                                                            viewBox="0 0 24 24" stroke="currentColor" width="12px"
                                                            height="12px"
                                                            x-bind:class="{ 'text-primary': sorted.field === 'name' && sorted.rule === 'asc' }">
                                                            <path d="M5 15l7-7 7 7"></path>
                                                        </svg>
                                                        <svg @click="sort('name', 'desc')" fill="none"
                                                            stroke-linecap="round" stroke-linejoin="round" stroke-width="4"
                                                            viewBox="0 0 24 24" stroke="currentColor" width="12px"
                                                            height="12px"
                                                            x-bind:class="{ 'text-primary': sorted.field === 'name' && sorted.rule === 'desc' }">
                                                            <path d="M19 9l-7 7-7-7"></path>
                                                        </svg>
                                                    </div>
                                                </div>
                                            </th>
                                            <th scope="col">
                                                <div class="d-flex gap-1">
                                                    <span>Email</span>
                                                    <div class="d-flex flex-column">
                                                        <svg @click="sort('email', 'asc')" fill="none" fill="none"
                                                            stroke-linecap="round" stroke-linejoin="round" stroke-width="4"
                                                            viewBox="0 0 24 24" stroke="currentColor" width="12px"
                                                            height="12px"
                                                            x-bind:class="{ 'text-primary': sorted.field === 'email' && sorted.rule === 'asc' }">
                                                            <path d="M5 15l7-7 7 7"></path>
                                                        </svg>
                                                        <svg @click="sort('email', 'desc')" fill="none"
                                                            stroke-linecap="round" stroke-linejoin="round" stroke-width="4"
                                                            viewBox="0 0 24 24" stroke="currentColor" width="12px"
                                                            height="12px"
                                                            x-bind:class="{'text-primary': sorted.field === 'email' && sorted.rule === 'desc' }">
                                                            <path d="M19 9l-7 7-7-7"></path>
                                                        </svg>
                                                    </div>
                                                </div>
                                            </th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <template x-for="(item, index) in items" :key="index">
                                            <tr x-show="checkView(index + 1)">
                                                <td x-text="index + 1"></td>
                                                <td x-text="item.name "></td>
                                                <td x-text="item.email"></td>
                                                <td x-data="{button: '<a href=\'#?token='+token+'\' class=\'btn btn-info mx-2\'>Edit</a><a href=\'#?token='+token+'\' class=\'btn btn-danger\'>Hapus</a>'}">
                                                    <div x-html="button"></div>
                                                </td>
                                            </tr>
                                        </template>
                                    </tbody>
                                </table>
                                <div class="pagination">
                                    <div class="page-item" @click.prevent="changePage(1)">
                                        <span class="page-link" role="button">First</span>
                                    </div>
                                    <div class="page-item" @click.prevent="changePage(currentPage - 1)">
                                        <span class="page-link" role="button">
                                            < </span>
                                    </div>
                                    <template x-for="(item, index) in pages" :key="index">
                                        <div class="page-item" @click.prevent="changePage(item)">
                                            <span class="page-link" x-bind:class="{ 'bg-info text-dark': currentPage === item }" x-text="item" role="button"></span>
                                        </div>
                                    </template>
                                    <div class="page-item" @click.prevent="changePage(currentPage + 1)">
                                        <span class="page-link" role="button">
                                            >
                                        </span>
                                    </div>
                                    <div class="page-item" @click.prevent="changePage(pagination.lastPage)">
                                        <span class="page-link" role="button">Last</span>
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
                data: [],
                items: [],
                listView: [5, 10, 25, 50, 100],
                view: 5,
                searchInput: '',
                pages: [],
                offset: 5,
                pagination: {
                    total: 0,
                    lastPage: 0,
                    perPage: 5,
                    currentPage: 1,
                    from: 1,
                    to: 1 * 5,
                },
                currentPage: 1,
                sorted: {
                    field: 'name',
                    rule: 'asc'
                },
                initData() {
                    async function fetchData() {
                        try {
                            const {data} = await axios.post('{{ route('admin.post.data.guru') }}', {}, {
                                headers: {
                                    'Authorization': 'Bearer ' + localStorage.getItem("token")
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
                        this.data = data.sort(this.compareOnKey('name', 'asc'));
                        this.items = data.sort(this.compareOnKey('name', 'asc'));
                        this.pagination.total = data.length;
                        this.pagination.lastPage = Math.ceil(data.length / 5);
                        this.listView.push(data.length);
                        this.listView = this.listView.sort(function(a, b){return a - b});
                        this.showPages();
                    })
                    .catch(error => {
                        console.error(error);
                    });
                },
                compareOnKey(key, rule) {
                    return function(a, b) {
                        if (key === 'name' || key === 'email') {
                            let comparison = 0
                            const fieldA = a[key].toUpperCase()
                            const fieldB = b[key].toUpperCase()
                            if (rule === 'asc') {
                                if (fieldA > fieldB) {
                                    comparison = 1;
                                } else if (fieldA < fieldB) {
                                    comparison = -1;
                                }
                            } else {
                                if (fieldA < fieldB) {
                                    comparison = 1;
                                } else if (fieldA > fieldB) {
                                    comparison = -1;
                                }
                            }
                            return comparison
                        } else {
                            if (rule === 'asc') {
                                return a.year - b.year
                            } else {
                                return b.year - a.year
                            }
                        }
                    }
                },
                sort(field, rule) {
                    this.items = this.items.sort(this.compareOnKey(field, rule));
                    this.sorted.field = field;
                    this.sorted.rule = rule;
                },
                checkView(index) {
                    return index > this.pagination.to || index < this.pagination.from ? false : true
                },
                search(value) {
                    if (value.length >= 1) {
                        const options = {
                            shouldSort: true,
                            keys: ['name'],
                            threshold: 0
                        }
                        const fuse = new Fuse(this.items, options);
                        this.items = fuse.search(value).map(elem => elem.item);
                        console.log(this.items);
                    } else {
                        this.items = this.data;
                    }
                },
                changePage(page) {
                    if (page >= 1 && page <= this.pagination.lastPage) {
                        this.currentPage = page
                        const total = this.items.length
                        const lastPage = Math.ceil(total / this.view) || 1
                        const from = (page - 1) * this.view + 1
                        let to = page * this.view
                        if (page === lastPage) {
                            to = total
                        }
                        this.pagination.total = total
                        this.pagination.lastPage = lastPage
                        this.pagination.perPage = this.view
                        this.pagination.currentPage = page
                        this.pagination.from = from
                        this.pagination.to = to
                        this.showPages()
                    }
                },
                showPages() {
                    const pages = []
                    let from = this.pagination.currentPage - Math.ceil(this.offset / 2)
                    if (from < 1) {
                        from = 1
                    }
                    let to = from + this.offset - 1
                    if (to > this.pagination.lastPage) {
                        to = this.pagination.lastPage
                    }
                    while (from <= to) {
                        pages.push(from)
                        from++
                    }
                    this.pages = pages
                },
                changeView() {
                    this.changePage(1);
                    this.showPages()
                }
            }
        }
    </script>
@endpush