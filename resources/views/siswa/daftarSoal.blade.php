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
                                    <h6 class="card-text">Mulai : <span x-text="item.waktu_mulai"></span></h6>
                                    <h6 class="card-text">Durasi : <span x-text="item.durasi"></span></h6>
                                    <a x-data="{ url: '{{ route('siswa.get.ujian') }}'+'?idSoal='+item.id+'&noSoal=1&token='+localStorage.getItem('token') }" :href="url" class="btn btn-primary">Mulai</a>
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
                }
            }
        }
    </script>
@endpush
