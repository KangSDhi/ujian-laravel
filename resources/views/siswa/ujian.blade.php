<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        .timer h1+h1:before {
            content: ":"
        }
    </style>
</head>

<body>
    <div x-data="ujian()" x-init="initData()">
        <nav class="navbar bg-primary">
            <div class="container-fluid">
                <span class="navbar-brand mb-0 h1 text-white">{{ $title }}</span>
            </div>
        </nav>
        <div class="container my-4">
            <div class="row">
                <div class="col-sm-8">
                    <article x-text="noSoal+'. '+pertanyaan"></article>
                    <template x-for="(item, index) in pilihanGanda" :key="index">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" :value="item"
                                x-model="jawabanPilihan">
                            <label class="form-check-label" x-text="item">
                            </label>
                        </div>
                    </template>
                    <button x-show="noSoal != 1" class="btn btn-sm btn-warning" @click="step('sebelumnya')">
                        <- Sebelumnya</button>
                            <button x-show="noSoal != pilihanGanda.length" class="btn btn-sm btn-primary my-3"
                                @click="step('selanjutnya')">Selanjutnya -></button>
                            <button x-show="noSoal == pilihanGanda.length" class="btn btn-sm btn-primary my-3"
                                @click="step('selesai')">Selesai!</button>
                </div>
                <div class="col-sm-4">
                    <div class="d-flex timer">
                        <h1 x-text="time().hours"></h1>
                        <h1 x-text="time().minutes"></h1>
                        <h1 x-text="time().seconds"></h1>
                    </div>
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h4>Navigasi Soal</h4>
                        </div>
                        <div class="card-body">
                            <div class="d-grid gap-2 d-md-flex">
                                <template x-for="(item, index) in dataUjian">
                                    <button class="btn btn-sm"
                                        :class="{
                                            'btn-outline-primary': index + 1 == noSoal,
                                            'btn-secondary': item
                                                .jawaban_pg == null && index + 1 != noSoal,
                                            'btn-primary': item
                                                .jawaban_pg != null && index + 1 != noSoal
                                        }"
                                        @click="changePage(index+1)">
                                        <span x-text="index+1"></span>
                                    </button>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="modal" tabindex="-1" id="error-modal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" x-text="errorTitle"></h5>
                            </div>
                            <div class="modal-body">
                                <p x-text="errorMessage"></p>
                            </div>
                            <div class="modal-footer">
                                <a :href="errorRedirect" class="btn btn-primary">Kembali</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"
        integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous">
    </script>
    <script>
        const ujian = () => {
            return {
                idSoal: '',
                idBank: '',
                noSoal: '',
                pertanyaan: '',
                jawabanPilihan: '',
                pilihanGanda: [],
                dataUjian: [],
                token: localStorage.getItem('token'),
                expiry: '',
                remaining: null,
                errorTitle: '',
                errorMessage: '',
                errorRedirect: '',
                initData() {
                    const urlParams = new URLSearchParams(location.search);
                    this.idSoal = urlParams.get('idSoal');
                    this.noSoal = urlParams.get('noSoal');
                    axios.post('{{ route('siswa.post.getSoal.ujian') }}', {
                            idSoal: this.idSoal,
                            noSoal: this.noSoal
                        }, {
                            headers: {
                                'Authorization': 'Bearer ' + this.token
                            }
                        })
                        .then(({
                            data
                        }) => {
                            console.log(data);
                            this.pertanyaan = data.pertanyaan;
                            this.pilihanGanda = data.data_ujian[this.noSoal - 1].pilihan_pg;
                            this.jawabanPilihan = data.data_ujian[this.noSoal - 1].jawaban_pg;
                            this.idBank = data.data_ujian[this.noSoal - 1].id_bank;
                            this.dataUjian = data.data_ujian;
                            this.expiry = Date.parse(data.ujian_selesai);
                            // console.log(new Date().setDate(new Date().getDate()+1));
                            this.setTimer();
                        })
                        .catch(({
                            response
                        }) => {
                            console.error(response);
                            const errorModal = new bootstrap.Modal(document.getElementById('error-modal'), {
                                keyboard: false
                            });
                            if (response.status == 404) {
                                // alert(response.data.message);
                                this.errorTitle = "Error " + response.status;
                                this.errorMessage = response.data.message;
                                this.errorRedirect = "{{ route('siswa.get.soal') }}" + "?token=" + this.token;
                                errorModal.show();
                            }
                        });
                },
                setTimer() {
                    this.setRemaining();
                    setInterval(() => {
                        console.log(this.remaining);
                        this.setRemaining();
                        if (this.remaining <= 0) {
                            this.finish();
                        }
                    }, 1000);
                },
                setRemaining() {
                    const diff = this.expiry - new Date().getTime();
                    this.remaining = parseInt(diff / 1000);
                },
                days() {
                    return {
                        value: this.remaining / 86400,
                        remaining: this.remaining % 86400
                    };
                },
                hours() {
                    return {
                        value: this.days().remaining / 3600,
                        remaining: this.days().remaining % 3600,
                    };
                },
                minutes() {
                    return {
                        value: this.hours().remaining / 60,
                        remaining: this.hours().remaining % 60,
                    };
                },
                seconds() {
                    return {
                        value: this.minutes().remaining,
                    };
                },
                format(value) {
                    return ("0" + parseInt(value)).slice(-2)
                },
                time() {
                    return {
                        hours: this.format(this.hours().value),
                        minutes: this.format(this.minutes().value),
                        seconds: this.format(this.seconds().value),
                    }
                },
                step(langkah) {
                    let status;
                    if (langkah == 'selanjutnya') {
                        status = 1;
                        this.update(parseInt(this.noSoal) + 1, status);
                    } else if (langkah == 'sebelumnya') {
                        status = 0;
                        this.update(parseInt(this.noSoal) - 1, status);
                    } else {
                        status = 2;
                        this.update(this.noSoal, status);
                    }
                },
                update(noSoal, status) {
                    axios.post('{{ route('siswa.post.update.ujian') }}', {
                            noSoal: noSoal,
                            idSoal: this.idSoal,
                            idBank: this.idBank,
                            jawabanPG: this.jawabanPilihan,
                            _token: "{{ csrf_token() }}",
                        }, {
                            headers: {
                                'Authorization': 'Bearer ' + this.token
                            }
                        })
                        .then(({
                            data
                        }) => {
                            if (noSoal == this.pilihanGanda.length && status == 2) {
                                if (confirm("Apakah Anda Sudah Selesai?")) {
                                    this.finish();
                                }
                            } else {
                                window.location.href = '{{ route('siswa.get.ujian') }}' + '?idSoal=' + data.idSoal +
                                    '&noSoal=' + data.noSoal + '&token=' + this.token;
                            }
                        })
                        .catch((error) => {
                            console.error(error);
                        });
                },
                changePage(noSoal) {
                    this.update(noSoal, 1);
                },
                finish(){
                    console.log("Redirect Ke Report");
                }
            }
        }
    </script>
</body>

</html>
