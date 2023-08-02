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
</head>

<body>
    <div x-data="resultUjian()" x-init="initData()">
        <nav class="navbar bg-primary">
            <div class="container-fluid">
                <span class="navbar-brand mb-0 h1 text-white">Nilai</span>
            </div>
        </nav>
        <div class="d-flex justify-content-center align-items-center my-5">
            <div class="shadow-lg p-3 mb-5 bg-body-tertiary rounded text-center" style="width: 18rem">
                <h1 class="display-1 font-weight-bold">Nilai</h1>
                <h3 class="display-3 font-weight-bold" x-text="nilai"></h3>
                <button class="btn btn-primary" @click="kembali">Kembali</button>
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
        const resultUjian = () => {
            return {
                idSoal: '',
                nilai: 0,
                token: localStorage.getItem('token'),
                initData() {
                    const urlParams = new URLSearchParams(location.search);
                    this.idSoal = urlParams.get('idSoal');

                    axios.post('{{ route('siswa.post.getResultUjian') }}', {
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
                            this.nilai = data.nilai;
                        })
                        .catch(({
                            response
                        }) => {
                            console.error(response);
                        });
                },
                kembali(){
                    window.location.href = '{{ route('siswa.get.soal') }}' + "?token=" + this.token;
                }
            }
        }
    </script>
</body>

</html>
