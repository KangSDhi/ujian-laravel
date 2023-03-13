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
            <label for="floatingInput">Email / NISN
                <div id="email-atau-nisn-error"></div>
            </label>
        </div>
        <div class="form-floating">
            <input id="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
            <label for="floatingPassword">Password
                <div id="password-error"></div>
            </label>
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
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"
        integrity="sha256-EIyuZ2Lbxr6vgKrEt8W2waS6D3ReLf9aeoYPZ/maJPI=" crossorigin="anonymous"></script>
    <script>
        const linkHome = document.getElementById("link-home");
        const linkAbout = document.getElementById("link-about");

        linkHome.classList.replace("text-white", "text-secondary");
        linkAbout.classList.replace("text-white", "text-secondary");

        const btnMasuk = document.getElementById("btn-masuk");
        btnMasuk.onclick = (event) => {
            const emailAtauNISN = document.getElementById("email-atau-nisn").value;
            const password = document.getElementById("password").value;

            console.log({
                emailAtauNISN,
                password
            });
            
            axios.post('{{ route('post.login') }}', {
                    emailAtauNISN: emailAtauNISN,
                    password: password
            })
            .then(function({ data }) {
                console.log(data);
                localStorage.setItem("token", data.token);
            })
            .catch(function(error) {
                console.error(error);
            });
        };
    </script>
@endpush
