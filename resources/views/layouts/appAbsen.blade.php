<!DOCTYPE html>
<html lang="en">
@include('layouts.head')

<body>
    @include('sweetalert::alert')
    <main class="main" id="top">
        <div class="container-fluid" data-layout="container">
            <div class="content">
                @include('layouts.header')
                @yield('content')
            </div>
        </div>
        <div class="modal fade" id="modalChangePassword" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content border-0">
                    <div class="position-absolute top-0 end-0 mt-3 me-3 z-index-1"><button
                            class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base"
                            data-bs-dismiss="modal" aria-label="Close"></button></div>
                    <form action="{{ route('change_password') }}" method="POST">
                        @csrf
                        <div class="modal-body p-0">
                            <div class="bg-light rounded-top-lg py-3 ps-4 pe-6">
                                <h4 class="mb-1">Change Password</h4>
                            </div>
                            <div class="p-3">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="d-flex">
                                            <div class="flex-1">
                                                <input type="hidden" name="email" value={{ Auth::user()->email }}>
                                                <div class="col-12">
                                                    <label class="form-label" for="password">New Password</label>
                                                    <input class="form-control form-select-sm  @error('password') is-invalid @enderror"
                                                        name="password" type="password" placeholder="Input Password Baru Anda"
                                                        value="{{ old('password') }}" />
                                                    @error('password')
                                                    <div class="invalid-feedback">
                                                        <strong>{{ $message }}</strong>
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="col-12 mt-2">
                                                    <label class="form-label" for="password_confirmation">Confirm Password</label>
                                                    <input class="form-control form-select-sm  @error('password_confirmation') is-invalid @enderror"
                                                        name="password_confirmation" type="password" placeholder="Confirm your Password"
                                                        value="{{ old('password_confirmation') }}" />
                                                    @error('password_confirmation')
                                                    <div class="invalid-feedback">
                                                        <strong>{{ $message }}</strong>
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="text-danger small mt-3 fs--1">
                                                   Note:
                                                </div>
                                                <div class="text-muted small mt-0 mb-2 fs--1">
                                                    - Password must contain number <br>
                                                    - Minimum 6 Character with 1 Uppercase Letter
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary btn-sm" type="button"
                                data-bs-dismiss="modal">Close</button>
                            <button class="btn btn-primary btn-sm" type="submit">Simpan </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </main>

    <script src="/../falcon/vendors/fullcalendar/main.min.js"></script>
    <script src="/../falcon/vendors/choices/choices.min.js"></script>
    <script src="/../falcon/vendors/popper/popper.min.js"></script>
    <script src="/../falcon/vendors/bootstrap/bootstrap.min.js"></script>
    <script src="/../falcon/vendors/anchorjs/anchor.min.js"></script>
    <script src="/../falcon/vendors/is/is.min.js"></script>
    <script src="/../falcon/vendors/echarts/echarts.min.js"></script>
    <script src="/../falcon/vendors/fontawesome/all.min.js"></script>
    <script src="/../falcon/vendors/lodash/lodash.min.js"></script>
    <script src="/../falcon/assets/js/theme.js"></script>
    <script src="/../falcon/assets/js/theme.js"></script>
    <script src="/../falcon/assets/js/config.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>

</body>


</html>