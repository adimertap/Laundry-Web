
<!DOCTYPE html>
<html lang="en">

@include('layouts.head')

<body>
    <div class="container" data-layout="container">
        <script>
            var isFluid = JSON.parse(localStorage.getItem('isFluid'));
          if (isFluid) {
            var container = document.querySelector('[data-layout]');
            container.classList.remove('container');
            container.classList.add('container-fluid');
          }
        </script>
        <div class="row flex-center min-vh-100 py-6 text-center">
            <div class="col-sm-10 col-md-8 col-lg-6 col-xxl-5"><a class="d-flex flex-center mb-4"
                    href="{{ route('pilihAplikasi') }}"><img class="me-2"
                        src="../../assets/img/icons/spot-illustrations/falcon.png" alt="" width="58"><span
                        class="font-sans-serif fw-bolder fs-5 d-inline-block">PT Riastavalasindo</span></a>
                <div class="card">
                    <div class="card-body p-4 p-sm-5">
                        <div class="fw-black lh-1 text-300 fs-error">500</div>
                        <p class="lead mt-4 text-800 font-sans-serif fw-semi-bold">Whoops, something went wrong!</p>
                        <hr>
                        <p>Error: {{ $th }}</p>
                        <p>Try refreshing the page, or going back and attempting the action again. If this problem persists,
                            <a href="{{ route('pilihAplikasi') }}">Back to Home Page</a>.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
  

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
