<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body>
    <header>
        <nav class="p-3 text-bg-dark">
            <div class="container">
                <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                    <a href="{{ route('get.landing')}}" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                        <i class="bi-vector-pen" style="font-size: 1.5rem;"></i>
                    </a>
                    <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                        <li><a id="link-home" href="{{ route('get.landing')}}" class="nav-link px-2 text-white">Beranda</a></li>
                        <li><a id="link-about" href="{{ route('get.about')}}" class="nav-link px-2 text-secondary">Tentang</a></li>
                    </ul>
                    <div class="text-end">
                        <button type="button" class="btn btn-outline-light me-2" onclick="location.href='{{ route('get.login') }}'">Masuk</button>
                        <button type="button" class="btn btn-warning" onclick="location.href='{{ route('get.login') }}'">Masuk, Tapi Warna Kuning</button>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <main x-data="baseLayout()" x-init="initFunction()">
        @yield('content')
    </main>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        const baseLayout = () => {
            return {
                initFunction(){
                    const token = localStorage.getItem('token');
                    if (token != null) {
                        axios.get('{{ url("/checkLogin") }}', {
                            headers: {
                                'Authorization': 'Bearer '+token
                            }
                        })
                        .then(({ data }) => {
                            window.location.href = data.link + "?token=" + token;
                        })
                        .catch((error) => {
                            console.error(error);
                        });
                    }
                }
            }
        }
    </script>
    @stack('script')
</body>
</html>