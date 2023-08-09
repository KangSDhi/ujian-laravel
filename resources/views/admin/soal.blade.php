@extends('admin.layouts.layout')

@section('title', $title)

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
                                            <label for="pertanyaan">Pertanyaan</label>
                                            <textarea class="form-control" rows="3" x-text="item.pertanyaan+' '+index"></textarea>
                                            {{-- <img class="img-thumbnail my-2" style="width: 40rem"
                                                    src="https://disk.mediaindonesia.com/files/news/2022/12/30/WhatsApp%20Image%202022-12-22%20at%2017.06.28.jpg"
                                                    alt=""> --}}
                                        </div>
                                        <div class="col-1 p-2">
                                            <button class="btn btn-secondary my-2">
                                                <i class="bi bi-card-image"></i>
                                            </button>
                                            <button class="btn btn-secondary">
                                                <i class="bi bi-eye-fill"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="pilihanA">Pilihan A</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control"
                                                        placeholder="Mohon Isi Pilihan A" x-model="item.pilihan_a" :value="item.pilihan_a">
                                                    <button class="btn btn-primary">
                                                        <i class="bi bi-card-image"></i>
                                                    </button>
                                                </div>
                                                {{-- <img class="img-thumbnail my-2" style="width: 20rem"
                                                        src="https://disk.mediaindonesia.com/files/news/2022/12/30/WhatsApp%20Image%202022-12-22%20at%2017.06.28.jpg"
                                                        alt=""> --}}
                                            </div>
                                            <div class="form-group">
                                                <label for="pilihanB">Pilihan B</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control"
                                                        placeholder="Mohon Isi Pilihan B" :value="item.pilihan_b">
                                                    <button class="btn btn-primary">
                                                        <i class="bi bi-card-image"></i>
                                                    </button>
                                                </div>
                                                {{-- <img class="img-thumbnail my-2" style="width: 20rem"
                                                        src="https://disk.mediaindonesia.com/files/news/2022/12/30/WhatsApp%20Image%202022-12-22%20at%2017.06.28.jpg"
                                                        alt=""> --}}
                                            </div>
                                            <div class="form-group">
                                                <label for="pilihanC">Pilihan C</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" placeholder="Pilihan C" :value="item.pilihan_c">
                                                    <button class="btn btn-primary">
                                                        <i class="bi bi-card-image"></i>
                                                    </button>
                                                </div>
                                                {{-- <img class="img-thumbnail my-2" style="width: 20rem"
                                                        src="https://disk.mediaindonesia.com/files/news/2022/12/30/WhatsApp%20Image%202022-12-22%20at%2017.06.28.jpg"
                                                        alt=""> --}}
                                            </div>
                                            <div class="form-group">
                                                <label for="pilihanD">Pilihan D</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" placeholder="Pilihan D" :value="item.pilihan_d">
                                                    <button class="btn btn-primary">
                                                        <i class="bi bi-card-image"></i>
                                                    </button>
                                                </div>
                                                {{-- <img class="img-thumbnail my-2" style="width: 20rem"
                                                        src="https://disk.mediaindonesia.com/files/news/2022/12/30/WhatsApp%20Image%202022-12-22%20at%2017.06.28.jpg"
                                                        alt=""> --}}
                                            </div>
                                            <div class="form-group">
                                                <label for="pilihanE">Pilihan E</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" placeholder="Pilihan E" :value="item.pilihan_e">
                                                    <button class="btn btn-primary">
                                                        <i class="bi bi-card-image"></i>
                                                    </button>
                                                </div>
                                                {{-- <img class="img-thumbnail my-2" style="width: 20rem"
                                                        src="https://disk.mediaindonesia.com/files/news/2022/12/30/WhatsApp%20Image%202022-12-22%20at%2017.06.28.jpg"
                                                        alt=""> --}}
                                            </div>
                                            <button @click="console.log(data[index])">Show</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </template>
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
                }
            }
        }
    </script>
@endpush
