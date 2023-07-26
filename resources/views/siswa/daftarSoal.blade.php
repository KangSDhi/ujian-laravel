@extends('siswa.layouts.layout')

@section('title', $title)

@section('content')
    <main class="col py-3">
        <section>

        </section>
        <section x-data="data()" x-init="initData()" class="content">
            <div class="container-fluid">
                <div class="row">
                    <template x-for="(item, index) in data" :key="index">
                        <div class="col-12 col-6 col-md-3 mb-2">
                            <div class="card text-bg-dark">
                                <div class="card-header">
                                    <h5 class="card-title" x-text="item.nama_soal"></h4>
                                </div>
                                <div class="card-body">
                                    <h6 class="card-text">Mulai : <span x-text="formatWaktuMulai(item.waktu_mulai)"></span></h6>
                                    <h6 class="card-text">Durasi : <span x-text="item.durasi"></span></h6>
                                    <template x-if="Date.now() >= Date.parse(item.waktu_mulai)">
                                        <a x-data="{ url: '{{ route('siswa.get.ujian') }}'+'?idSoal='+item.id+'&noSoal=1&token='+localStorage.getItem('token') }" :href="url" class="btn btn-primary">
                                            <i class="bi bi-play-fill"></i>
                                            Mulai
                                        </a>
                                    </template>
                                    <template x-if="Date.now() <= Date.parse(item.waktu_mulai)">
                                        <button class="btn btn-secondary" disabled>
                                            <i class="bi bi-lock-fill"></i>
                                            Belum Mulai
                                        </button>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </section>
    </main>
@endsection

@push('script')
    <script>
        const data = () => {
            return {
                token: localStorage.getItem('token'),
                data: [],
                initData() {
                    async function fetchData() {
                        try {
                            const {
                                data
                            } = await axios.post('{{ route('siswa.post.data.soal') }}', {}, {
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
                            this.data = data;
                            console.log(data);
                        })
                        .catch(error => {
                            console.error(error);
                        })
                },
                formatWaktuMulai(waktu_mulai){
                    const waktu_mulai_parse = new Date(waktu_mulai);
                    const year = waktu_mulai_parse.getFullYear();
                    const month = waktu_mulai_parse.getMonth() + 1;
                    const date = waktu_mulai_parse.getDate();
                    const hour = waktu_mulai_parse.getHours();
                    const minute = waktu_mulai_parse.getMinutes();
                    return `${this.addZero(date)}/${this.addZero(month)}/${year} (${this.addZero(hour)}:${this.addZero(minute)})`;
                },
                addZero(i){
                    if (i < 10) {
                        i = "0" + i;
                    }
                    return i;
                }
            }
        }
    </script>
@endpush
