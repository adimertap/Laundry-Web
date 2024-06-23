<!DOCTYPE html>
<html lang="en">
@include('auth.loginHead')
<body>
    @include('sweetalert::alert')
    <main class="main" id="top">
        <div class="container-fluid">
            <div class="row min-vh-100 flex-center g-0">
                <div class="col-lg-8 col-xxl-7 py-3 position-relative">
                    <div class="card overflow-hidden z-index-1">
                        <div class="card-body p-0">
                            <div class="row g-0 h-100">
                                <div class="col-md-5 text-center bg-card-gradient">
                                    <div class="position-relative p-4 pt-md-5 pb-md-7 light">
                                        <div class="bg-holder bg-auth-card-shape"
                                            style="background-image:url(../../../assets/img/icons/spot-illustrations/half-circle.png);">
                                        </div>
                                        <div class="z-index-1 position-relative"><a
                                                class="link-light mb-4 font-sans-serif fs-3 d-inline-block fw-bolder"
                                                href="#">Aplikasi Money Changer dan Laundry</a>
                                            <p class="opacity-75 text-white">Silahkan melakukan login terlebih dahulu
                                                sebelum masuk ke dalam sistem kasir money changer dan laundry!
                                            </p>
                                        </div>
                                    </div>
                                    <div class="mt-3 mb-4 pb-3 mt-md-4 mb-md-5 light">
                                        <p class="text-white">PT. Riasta Valasindo
                                        </p>
                                        {{-- <p class="text-white">Web Absensi <u><a
                                                    href="{{ url('http://127.0.0.1:8001/login') }}"
                                                    class="text-white underline">Klik disini</a></u> </p> --}}
                                    </div>
                                </div>
                                <div class="col-md-7 d-flex flex-center">
                                    <div class="p-4 p-md-5 flex-grow-1">
                                        <div class="row flex-between-center">
                                            <div class="col-auto">
                                                <h3>Account Login</h3>
                                            </div>
                                        </div>
                                        <form class="form-body" form method="POST" action="{{ route('login') }}">
                                            @csrf
                                            <div class="mb-3">
                                                <label class="form-label" for="inputEmailAddress">Email address</label>
                                                <input class="form-control @error('email') is-invalid @enderror"
                                                    id="inputEmailAddress" placeholder="Email Address" type="email"
                                                    name="email" value="{{ old('email') }}" required
                                                    autocomplete="email" autofocus>
                                                @error('email')
                                                <div class="invalid-feedback">
                                                    <strong>Email atau Password yang Anda Masukan Salah</strong>
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <div class="d-flex justify-content-between"><label class="form-label"
                                                        for="inputChoosePassword">Password</label></div>
                                                <input class="form-control @error('password') is-invalid @enderror"
                                                    id="inputChoosePassword" placeholder="Enter Password" type="text"
                                                    name="password" required autocomplete="current-password">
                                                @error('password')
                                                <div class="invalid-feedback">
                                                    <strong>Email atau Password yang Anda Masukan Salah</strong>
                                                </div>
                                                @enderror
                                            </div>


                                            <div class="row flex-between-center">
                                                <div class="col-auto">
                                                    <div class="form-check mb-0">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="card-checkbox" checked="" name="remember" {{
                                                            old('remember') ? 'checked' : '' }}>
                                                        <label class="form-check-label mb-0"
                                                            for="card-checkbox">Remember me</label>
                                                    </div>
                                                </div>
                                                <div class="col-auto"><a class="fs--1"
                                                        href="{{ route('password.request') }}">Forgot Password?</a>
                                                </div>
                                            </div>
                                            <div class="mb-3"><button class="btn btn-primary d-block w-100 mt-3"
                                                    type="submit">Log in</button></div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </main>

@include('auth.loginScript')
  

</body>

</html>