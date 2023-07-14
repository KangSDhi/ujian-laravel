@extends('auth.layouts.layout')

@section('title', $title)

@push('css')
    <style>
        .form-signin {
            width: 100%;
            max-width: 330px;
            padding: 15px;
            margin: auto;
        }

        .form-signin .checkbox {
            font-weight: 400;
        }

        .form-signin .form-floating:focus-within {
            z-index: 2;
        }

        .form-signin input[type="email"] {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }

        .form-signin input[type="password"] {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css" rel="stylesheet">
@endpush

@section('content')
    <form class="form-signin">
        <div class="text-center">
            <img class="mb-4" src="{{ asset('assets/img/logo_smk.png') }}" alt="" width="82" height="67">
        </div>
        <h1 class="h3 mb-3 fw-normal">Silahkan Masuk</h1>

        <div class="form-floating">
            <input id="email-atau-nisn" type="text" class="form-control" id="floatingInput"
                placeholder="name@example.com">
            <label id="label-email-atau-nisn" for="floatingInput">Email / NISN</label>
        </div>
        <div class="form-floating">
            <input id="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
            <label id="label-password" for="floatingPassword">Password</label>
        </div>

        <div class="checkbox mb-3">
            <label>
                <input type="checkbox" value="remember-me"> Ingat Saya
            </label>
        </div>
        <button id="btn-masuk" class="w-100 btn btn-lg btn-primary" type="button">Masuk</button>
    </form>
@endsection

@push('script')
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>
    <script>
        const linkHome = document.getElementById("link-home");
        const linkAbout = document.getElementById("link-about");

        linkHome.classList.replace("text-white", "text-secondary");
        linkAbout.classList.replace("text-white", "text-secondary");

        const btnMasuk = document.getElementById("btn-masuk");
        btnMasuk.onclick = (event) => {
            const emailAtauNISN = document.getElementById("email-atau-nisn").value;
            const password = document.getElementById("password").value;

            axios.post('{{ route('post.login') }}', {
                    emailAtauNISN: emailAtauNISN,
                    password: password,
                    _token: "{{ csrf_token() }}",
            })
            .then(function({ data }) {
                localStorage.setItem("token", data.token);
                window.location.href = data.link+"?token="+localStorage.getItem("token");
            })
            .catch(function({ response }) {
                const labelEmailNISN = document.getElementById("label-email-atau-nisn");
                const labelPassword = document.getElementById("label-password");
                labelEmailNISN.innerHTML = "Email / NISN";
                labelPassword.innerHTML = "Password";
                labelEmailNISN.classList.remove('text-danger');
                labelPassword.classList.remove('text-danger');
                if (response.status === 422) {
                    Object.keys(response.data).forEach(function(key){
                        if (key === "emailAtauNISN") {
                            labelEmailNISN.classList.add('text-danger');
                            labelEmailNISN.innerHTML = response.data[key][0];
                        }

                        if (key === "password") {
                            labelPassword.classList.add('text-danger');
                            labelPassword.innerHTML = response.data[key][0];
                        }
                    });
                }

                if (response.status === 401) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: response.data.message
                    });
                }
            });
        };
    </script>
@endpush
