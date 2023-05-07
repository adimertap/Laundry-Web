<!DOCTYPE html>
<html lang="en">
    @include('layouts.head')

<body>
    @include('sweetalert::alert')
    <main class="main" id="top">
        <div class="container-fluid" data-layout="container">
            @include('layouts.navbar')
            <div class="content">
                @include('layouts.header')
                @yield('content')
            </div>

        </div>
    </main>
  
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
