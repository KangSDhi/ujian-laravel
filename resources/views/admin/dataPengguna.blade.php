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
                        <h1 class="m-0">Data Pengguna</h1>
                    </div>
                    <div class="col-12 col-sm-6" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                        <ol class="breadcrumb float-end">
                            <li class="breadcrumb-item">
                                <a href="#">Aplikasi Ujian</a>
                            </li>
                            <li class="breadcrumb-item active">
                                Data Pengguna
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex flex-row-reverse my-2">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#tambahDataModal">
                                <i class="bi bi-person-plus-fill"></i>
                                Tambah Data
                            </button>
                        </div>
                    </div>
                    <div x-data="dataTable()" x-init="initData()" class="col-12 col-sm-12 col-md-12">
                        <div class="card shadow">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex gap-2 align-items-center">
                                        <div class="align-self-center">Show</div>
                                        <select x-model="view" @change="changeView()"
                                            class="form-select form-select-sm align-self-center">
                                            <template x-for="(item, index) in listViewBinding()" :key="index">
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
                                                            x-bind:class="{
                                                                'text-primary': sorted.field === 'name' && sorted
                                                                    .rule ===
                                                                    'asc'
                                                            }">
                                                            <path d="M5 15l7-7 7 7"></path>
                                                        </svg>
                                                        <svg @click="sort('name', 'desc')" fill="none"
                                                            stroke-linecap="round" stroke-linejoin="round" stroke-width="4"
                                                            viewBox="0 0 24 24" stroke="currentColor" width="12px"
                                                            height="12px"
                                                            x-bind:class="{
                                                                'text-primary': sorted.field === 'name' && sorted
                                                                    .rule ===
                                                                    'desc'
                                                            }">
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
                                                            x-bind:class="{
                                                                'text-primary': sorted.field === 'email' && sorted
                                                                    .rule === 'asc'
                                                            }">
                                                            <path d="M5 15l7-7 7 7"></path>
                                                        </svg>
                                                        <svg @click="sort('email', 'desc')" fill="none"
                                                            stroke-linecap="round" stroke-linejoin="round" stroke-width="4"
                                                            viewBox="0 0 24 24" stroke="currentColor" width="12px"
                                                            height="12px"
                                                            x-bind:class="{
                                                                'text-primary': sorted.field === 'email' && sorted
                                                                    .rule === 'desc'
                                                            }">
                                                            <path d="M19 9l-7 7-7-7"></path>
                                                        </svg>
                                                    </div>
                                                </div>
                                            </th>
                                            <th scope="col">
                                                <div class="d-flex gap-1">
                                                    <span>Role</span>
                                                    <div class="d-flex flex-column">
                                                        <svg @click="sort('role', 'asc')" fill="none" fill="none"
                                                            stroke-linecap="round" stroke-linejoin="round" stroke-width="4"
                                                            viewBox="0 0 24 24" stroke="currentColor" width="12px"
                                                            height="12px"
                                                            x-bind:class="{
                                                                'text-primary': sorted.field === 'role' && sorted
                                                                    .rule ===
                                                                    'asc'
                                                            }">
                                                            <path d="M5 15l7-7 7 7"></path>
                                                        </svg>
                                                        <svg @click="sort('role', 'desc')" fill="none"
                                                            stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="4" viewBox="0 0 24 24" stroke="currentColor"
                                                            width="12px" height="12px"
                                                            x-bind:class="{
                                                                'text-primary': sorted.field === 'role' && sorted
                                                                    .rule ===
                                                                    'desc'
                                                            }">
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
                                                <td x-text="item.role"></td>
                                                <td>
                                                    <button class="btn btn-info"
                                                        @click="editData(item.email)">Edit</button>
                                                    <button class="btn btn-danger" @click="hapusData(item.email)">Hapus</button>
                                                </td>
                                            </tr>
                                        </template>
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex">
                                        <div class="pagination">
                                            <div class="page-item" @click.prevent="clickPage(1)">
                                                <span class="page-link" role="button">Awal</span>
                                            </div>
                                            <div class="page-item" @click.prevent="clickPage(pagination.currentPage - 1)">
                                                <span class="page-link" role="button">
                                                    < </span>
                                            </div>
                                            <template x-for="(item, index) in pagination.pages" :key="index">
                                                <div class="page-item" @click.prevent="clickPage(item)">
                                                    <span class="page-link"
                                                        x-bind:class="{ 'bg-info text-dark': pagination.currentPage === item }"
                                                        x-text="item" role="button"></span>
                                                </div>
                                            </template>
                                            <div class="page-item" @click.prevent="clickPage(pagination.currentPage + 1)">
                                                <span class="page-link" role="button">
                                                    >
                                                </span>
                                            </div>
                                            <div class="page-item" @click.prevent="clickPage(pagination.lastPage)">
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

    <!-- Modal Tambah Pengguna -->
    <div x-data="formTambahPengguna()" class="modal fade" id="tambahDataModal" tabindex="-1"
        aria-labelledby="tambahDataModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="tambahDataModalLabel">Tambah Pengguna</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" @click="resetForm()" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="inputNamaLengkap" class="form-label">Nama Lengkap</label>
                        <input type="text" :class="errorNamaLengkap ? 'form-control is-invalid' : 'form-control'"
                            id="inputNamaLengkap">
                        <div x-show="errorNamaLengkap" class="invalid-feedback">
                            <div x-text="messageErrorNamaLengkap"></div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="inputEmail" class="form-label">Email</label>
                        <input type="email" :class="errorEmail ? 'form-control is-invalid' : 'form-control'" id="inputEmail">
                        <div x-show="errorEmail" class="invalid-feedback">
                            <div x-text="messageErrorEmail"></div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="inputNamaLengkap" class="form-label">Role</label>
                        <select id="inputRole" :class="errorRole ? 'form-select is-invalid' : 'form-select'">
                            @foreach ($dataUsersRole as $data)
                                <option value="{{ $data->id }}">{{ $data->role }}</option>
                            @endforeach
                        </select>
                        <div x-show="errorRole" class="invalid-feedback">
                            <div x-text="messageErrorRole"></div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="inputPassword" class="form-label">Password</label>
                        <div class="input-group">
                            <input :type="showPassword ? 'password' : 'text'" type="password" :class="errorPassword ? 'form-control is-invalid': 'form-control'"
                                id="inputPassword">
                            <span class="input-group-text pe-auto" @click="showPassword = !showPassword">
                                <i :class="showPassword ? 'bi bi-eye-slash' : 'bi bi-eye-fill'"></i>
                            </span>
                            <div x-show="errorPassword" class="invalid-feedback">
                                <div x-text="messageErrorPassword"></div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="inputKonfirmasiPassword" class="form-label">Konfirmasi Password</label>
                        <div class="input-group">
                            <input :type="showKonfirmasiPassword ? 'password' : 'text'" type="password"
                                :class="errorKonfirmasiPassword ? 'form-control is-invalid' : 'form-control'" id="inputKonfirmasiPassword">
                            <span class="input-group-text" @click="showKonfirmasiPassword = !showKonfirmasiPassword">
                                <i :class="showKonfirmasiPassword ? 'bi bi-eye-slash' : 'bi bi-eye-fill'"></i>
                            </span>
                            <div x-show="errorKonfirmasiPassword" class="invalid-feedback">
                                <div x-text="messageErrorKonfirmasiPassword"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" @click="resetForm()">Tutup</button>
                    <button type="button" class="btn btn-primary" @click="simpanData()">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <div x-data="formEditPengguna()" class="modal fade" id="editDataModal" tabindex="-1"
        aria-labelledby="editDataModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editDataModalLabel">Edit Pengguna</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" @click="resetForm()" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="editInputID">
                    <div class="mb-3">
                        <label for="editInputNamaLengkap" class="form-label">Nama Lengkap</label>
                        <input type="text" :class="errorNamaLengkap ? 'form-control is-invalid' : 'form-control'" id="editInputNamaLengkap">
                        <div x-show="errorNamaLengkap" class="invalid-feedback">
                            <div x-text="messageErrorNamaLengkap"></div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="editInputEmail" class="form-label">Email</label>
                        <input type="email" :class="errorEmail ? 'form-control is-invalid' : 'form-control'" id="editInputEmail">
                        <div x-show="errorEmail" class="invalid-feedback">
                            <div x-text="messageErrorEmail"></div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="editInputRole" class="form-label">Role</label>
                        <select id="editInputRole" :class="errorRole ? 'form-select is-invalid' : 'form-select'">
                            @foreach ($dataUsersRole as $data)
                                <option value="{{ $data->id }}">{{ $data->role }}</option>
                            @endforeach
                        </select>
                        <div x-show="errorRole" class="invalid-feedback">
                            <div x-text="messageErrorRole"></div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="editInputPassword" class="form-label">Password</label>
                        <div class="input-group">
                            <input :type="showPassword ? 'password' : 'text'" type="password" :class="errorPassword ? 'form-control is-invalid' : 'form-control'"
                                id="editInputPassword">
                            <span class="input-group-text pe-auto" @click="showPassword = !showPassword">
                                <i :class="showPassword ? 'bi bi-eye-slash' : 'bi bi-eye-fill'"></i>
                            </span>
                            <div x-show="errorPassword" class="invalid-feedback">
                                <div x-text="messageErrorPassword"></div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="editInputKonfirmasiPassword" class="form-label">Konfirmasi Password</label>
                        <div class="input-group">
                            <input :type="showKonfirmasiPassword ? 'password' : 'text'" type="password"
                                :class="errorKonfirmasiPassword ? 'form-control is-invalid' : 'form-control'" id="editInputKonfirmasiPassword">
                            <span class="input-group-text" @click="showKonfirmasiPassword = !showKonfirmasiPassword">
                                <i :class="showKonfirmasiPassword ? 'bi bi-eye-slash' : 'bi bi-eye-fill'"></i>
                            </span>
                            <div x-show="errorKonfirmasiPassword" class="invalid-feedback">
                                <div x-text="messageErrorKonfirmasiPassword"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" @click="resetForm()">Tutup</button>
                    <button type="button" class="btn btn-primary" @click="updateData()">Update</button>
                </div>
            </div>
        </div>
    </div>



@endsection

@push('script')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fuse.js/dist/fuse.js"></script>
    <script>
        const dataTable = () => {
            return {
                token: localStorage.getItem('token'),
                data: [],
                items: [],
                listView: [10, 25, 50, 100],
                view: 10,
                searchInput: '',
                pagination: {
                    pages: [],
                    offset: 5,
                    total: 0,
                    lastPage: 0,
                    perPage: 5,
                    currentPage: 1,
                    from: 1,
                    to: 10,
                },
                sorted: {
                    field: 'name',
                    rule: 'asc'
                },
                initData() {
                    async function fetchData() {
                        try {
                            const {
                                data
                            } = await axios.post('{{ route('admin.post.data.pengguna') }}', {}, {
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
                            this.items = this.data = data.sort(this.compareOnKey('name', 'asc'));
                            this.pagination.lastPage = Math.ceil(data.length / this.view);
                            this.pagination.total = data.length;

                            this.showPages();
                        })
                        .catch(error => {
                            console.error(error);
                        });
                },
                compareOnKey(key, rule) {
                    return function(a, b) {
                        if (key === 'name' || key === 'email' || key === 'role') {
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
                            keys: ['name', 'email', 'role'],
                            threshold: 0
                        }
                        const fuse = new Fuse(this.items, options);
                        const search = fuse.search(value).map(elem => elem.item);
                        this.items = search;
                    } else {
                        this.items = this.data;
                    }
                },
                changePage(page) {
                    if (page >= 1 && page <= this.pagination.lastPage) {
                        this.showPages()
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

                    }
                },
                showPages() {
                    const pages = []
                    let from = this.pagination.currentPage - Math.ceil(this.pagination.offset / 2)
                    if (from < 1) {
                        from = 1
                    }
                    let to = from + this.pagination.offset - 1
                    if (to > this.pagination.lastPage) {
                        to = this.pagination.lastPage
                    }
                    while (from <= to) {
                        pages.push(from)
                        from++
                    }
                    this.pagination.pages = pages
                },
                changeView() {
                    this.changePage(1);
                    this.showPages()
                },
                clickPage(page) {
                    this.changePage(page)
                    this.showPages()
                },
                listViewBinding() {
                    const list = [];
                    for (let index = 0; index < this.listView.length; index++) {
                        if (this.listView[index] < this.items.length) {
                            list.push(this.listView[index])
                        }
                    }

                    const itemsLenth = parseInt(JSON.stringify(this.items.length))

                    list.push(itemsLenth);
                    return list;
                },
                editData(email) {
                    editDataModal.show();
                    axios.get('{{ url('/admin/pengguna/get') }}' + '/' + email, {
                            headers: {
                                'Authorization': 'Bearer ' + localStorage.getItem("token")
                            }
                        })
                        .then(({
                            data
                        }) => {
                            console.log(data.data);
                            document.getElementById('editInputNamaLengkap').value = data.data.name;
                            document.getElementById('editInputEmail').value = data.data.email;
                            document.getElementById('editInputRole').value = data.data.role_id;
                            document.getElementById('editInputID').value = data.data.id;
                            editDataModal.show();
                        })
                        .catch((error) => {
                            console.error(error);
                        });
                },
                hapusData(email){
                    if (confirm("Hapus Data "+email)) {
                        axios.get('{{ url('/admin/pengguna/delete') }}' + '/' + email, {
                            headers: {
                                'Authorization': 'Bearer ' + localStorage.getItem("token")
                            }
                        })
                        .then(({data}) => {
                            if (data.success) {
                                setTimeout(() => {
                                    location.reload();
                                }, 3000);
                            }
                        })
                        .catch(({response}) => {
                            console.error(response);
                        });
                    } else {
                        alert("Batal Menghapus Data!");
                    }
                }
            }
        }
    </script>
    <script>
        const tambahDataModal = new bootstrap.Modal('#tambahDataModal', {
            keyboard: false,
            backdrop: 'static'
        });

        const formTambahPengguna = () => {
            return {
                showPassword: true,
                showKonfirmasiPassword: true,
                errorNamaLengkap: false,
                messageErrorNamaLengkap: "",
                errorEmail: false,
                messageErrorEmail: "",
                errorRole: false,
                messageErrorRole: "",
                errorPassword: false,
                messageErrorPassword: "",
                errorKonfirmasiPassword: false,
                messageErrorKonfirmasiPassword: "",
                simpanData() {
                    const namaLengkap = document.getElementById('inputNamaLengkap').value;
                    const email = document.getElementById('inputEmail').value;
                    const role = document.getElementById('inputRole').value;
                    const password = document.getElementById('inputPassword').value;
                    const konfirmasiPassword = document.getElementById('inputKonfirmasiPassword').value;

                    axios.post('{{ route('admin.post.store.pengguna') }}', {
                            namaLengkap,
                            email,
                            role,
                            password,
                            konfirmasiPassword
                        }, {
                            headers: {
                                'Authorization': 'Bearer ' + localStorage.getItem("token")
                            }
                        })
                        .then(({data}) => {
                            if (data.success == true) {
                                document.getElementById('inputNamaLengkap').value = '';
                                document.getElementById('inputEmail').value = '';
                                document.getElementById('inputRole').value = '';
                                document.getElementById('inputPassword').value = '';
                                document.getElementById('inputKonfirmasiPassword').value = '';
                                tambahDataModal.hide();
                                location.reload();
                            }
                        })
                        .catch(({response}) => {

                            const data = response.data.data;

                            this.errorNamaLengkap = false;
                            this.messageErrorNamaLengkap = "";
                            this.errorEmail = false;
                            this.messageErrorEmail = "";
                            this.errorRole = false;
                            this.messageErrorRole = "";
                            this.errorPassword = false;
                            this.messageErrorPassword = "";
                            this.errorKonfirmasiPassword = false;
                            this.messageErrorKonfirmasiPassword = "";

                            Object.keys(data).forEach(key => {
                                console.log(key);
                                if (key == 'namaLengkap') {
                                    this.errorNamaLengkap = true;
                                    this.messageErrorNamaLengkap = data[key][0];
                                }

                                if (key == 'email') {
                                    this.errorEmail = true;
                                    this.messageErrorEmail = data[key][0];
                                }

                                if (key == 'role') {
                                    this.errorRole = true;
                                    this.messageErrorRole = data[key][0];
                                }

                                if (key == 'password') {
                                    this.errorPassword = true;
                                    this.messageErrorPassword = data[key][0];
                                }

                                if (key == 'konfirmasiPassword') {
                                    this.errorKonfirmasiPassword = true;
                                    this.messageErrorKonfirmasiPassword = data[key][0];
                                }
                            });

                        });
                },
                resetForm(){
                    this.showPassword = true;
                    this.showKonfirmasiPassword = true;
                    this.errorNamaLengkap = false;
                    this.messageErrorNamaLengkap = "";
                    this.errorEmail = false;
                    this.messageErrorEmail = "";
                    this.errorRole = false;
                    this.messageErrorRole = "";
                    this.errorPassword = false;
                    this.messageErrorPassword = "";
                    this.errorKonfirmasiPassword = false;
                    this.messageErrorKonfirmasiPassword = "";
                }
            }
        }
    </script>
    <script>
        const editDataModal = new bootstrap.Modal('#editDataModal', {
            keyboard: false,
            backdrop: 'static'
        });

        const formEditPengguna = () => {
            return {
                showPassword: true,
                showKonfirmasiPassword: true,
                errorNamaLengkap: false,
                messageErrorNamaLengkap: "",
                errorEmail: false,
                messageErrorEmail: "",
                errorRole: false,
                messageErrorRole: "",
                errorPassword: false,
                messageErrorPassword: "",
                errorKonfirmasiPassword: false,
                messageErrorKonfirmasiPassword: "",
                updateData() {
                    const id = document.getElementById('editInputID').value;
                    const namaLengkap = document.getElementById('editInputNamaLengkap').value;
                    const email = document.getElementById('editInputEmail').value;
                    const role = document.getElementById('editInputRole').value;
                    const password = document.getElementById('editInputPassword').value;
                    const konfirmasiPassword = document.getElementById('editInputKonfirmasiPassword').value;

                    axios.post('{{ route('admin.post.update.pengguna') }}', {
                            id,
                            namaLengkap,
                            email,
                            role,
                            password,
                            konfirmasiPassword
                        }, {
                            headers: {
                                'Authorization': 'Bearer ' + localStorage.getItem("token")
                            }
                        })
                        .then(({data}) => {
                            if (data.success == true) {
                                document.getElementById('editInputPassword').value = '';
                                document.getElementById('editInputKonfirmasiPassword').value = '';
                                editDataModal.hide();
                                location.reload();
                            }
                        })
                        .catch(({response}) => {
                            const data = response.data.data;

                            this.errorNamaLengkap = false;
                            this.messageErrorNamaLengkap = "";
                            this.errorEmail = false;
                            this.messageErrorEmail = "";
                            this.errorRole = false;
                            this.messageErrorRole = "";
                            this.errorPassword = false;
                            this.messageErrorPassword = "";
                            this.errorKonfirmasiPassword = false;
                            this.messageErrorKonfirmasiPassword = "";

                            Object.keys(data).forEach(key => {
                                if (key == 'namaLengkap') {
                                    this.errorNamaLengkap = true;
                                    this.messageErrorNamaLengkap = data[key][0];
                                }

                                if (key == 'email') {
                                    this.errorEmail = true;
                                    this.messageErrorEmail = data[key][0];
                                }

                                if (key == 'role') {
                                    this.errorRole = true;
                                    this.messageErrorRole = data[key][0];
                                }

                                if (key == 'password') {
                                    this.errorPassword = true;
                                    this.messageErrorPassword = data[key][0];
                                }

                                if (key == 'konfirmasiPassword') {
                                    this.errorKonfirmasiPassword = true;
                                    this.messageErrorKonfirmasiPassword = data[key][0]; 
                                }
                            });
                        })
                },
                resetForm(){
                    document.getElementById('editInputPassword').value = '';
                    document.getElementById('editInputKonfirmasiPassword').value = '';

                    this.showPassword = true;
                    this.showKonfirmasiPassword = true;
                    this.errorNamaLengkap = false;
                    this.messageErrorNamaLengkap = "";
                    this.errorEmail = false;
                    this.messageErrorEmail = "";
                    this.errorRole = false;
                    this.messageErrorRole = "";
                    this.errorPassword = false;
                    this.messageErrorPassword = "";
                    this.errorKonfirmasiPassword = false;
                    this.messageErrorKonfirmasiPassword = "";
                }
            }
        }
    </script>
@endpush
