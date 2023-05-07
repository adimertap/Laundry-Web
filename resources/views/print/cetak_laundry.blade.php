<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8"><!-- /Added by HTTrack -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cetak Receipt</title>
    <link rel="manifest" href="/../../falcon/assets/img/favicons/manifest.json">
    <meta name="msapplication-TileImage" content="assets/img/favicons/mstile-150x150.png">
    <meta name="theme-color" content="#ffffff">
    <script src="/../../falcon/assets/js/config.js"></script>
    <script src="/../../falcon/vendors/overlayscrollbars/OverlayScrollbars.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js" defer></script>
    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700%7cPoppins:300,400,500,600,700,800,900&amp;display=swap"
        rel="stylesheet">
    <link href="/../../falcon/vendors/overlayscrollbars/OverlayScrollbars.min.css" rel="stylesheet">
    <link href="/../../falcon/assets/css/theme-rtl.min.css" rel="stylesheet" id="style-rtl" disabled="true">
    <link href="/../../falcon/assets/css/theme.min.css" rel="stylesheet" id="style-default">
    <link href="/../../falcon/assets/css/user-rtl.min.css" rel="stylesheet" id="user-style-rtl" disabled="true">
    <link href="/../../falcon/assets/css/user.min.css" rel="stylesheet" id="user-style-default">
    <style>
        @page {
            size: 58mm 50mm
        }

        body.receipt .sheet {
            width: 58mm;
            height: 50mm
        }

        @media print {
            body.receipt {
                width: 58mm
            }
        }

        body {
            margin: 0
        }

        margin: 0;
        overflow: hidden;
        position: relative;
        box-sizing: border-box;
        page-break-after: always;
        }

        @media print {
            @page {
                size: 80mm;
                size: 80mm portrait;
                margin: 0;
                border: 1px solid red;
                position: absolute;
            }

            .anjay {
                page-break-after: always;
            }
        }

        .page {
            width: 80mm;
            min-height: auto;
            padding: 0.4cm;
            margin: 0cm auto;
            border: 1px #D3D3D3 solid;
            border-radius: 5px;
            background: white;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        .text-kecil {
            font-size: 16pt;
        }

        hr.tebal {
            height: 2px;
            border-width: 0;
            color: gray;
            background-color: gray;
            border-top: solid 1px #000 !important;
        }

        @page {
            size: A4;
            margin: 0;
        }

        hr.putus {
            border-top: 2px dashed rgb(219, 218, 218);
        }
    </style>
</head>

<body class="page" onload="window.print()">
    <main class="text-kecil" style="color: white; top: 0">
        <section class="page_satu pb-0">
            <div class="row align-items-center  text-center mb-3 mt-3">
                <div class="col-sm-12 text-center mt-3">
                    <h6 class="text-danger fw-bold m-0 ">RIASTA LAUNDRY & DRY</h6>
                    <p class="fs--2 text-black m-0 text-600">PADMA UTARA, KUTA-BALI</p>
                    <p class="fs--2 text-black m-0 text-600">PHONE: (0361) 4756405</p>
                </div>
            </div>
            <hr class="tebal mb-2" style="height:0.3px;border-width:0;color:gray;background-color:gray">
            <div class="row">
                <div class="col-3">
                    <h6 class="m-0 fs--2 text-600">Name</h6>
                </div>
                <div class="col-9">
                    <p class="fs--2 text-black m-0 text-600">: {{ $tr->nama_customer }}</p>
                </div>
            </div>
            <div class="row mt-0">
                <div class="col-3">
                    <h6 class="m-0 fs--2 text-600">Alamat</h6>
                </div>
                <div class="col-9">
                    <p class="fs--2 text-black m-0 text-600">: {{ $tr->alamat ?? "-" }}</p>
                </div>
            </div>
            <div class="row mt-0">
                <div class="col-3">
                    <h6 class="m-0 fs--2 text-600">Date</h6>
                </div>
                <div class="col-9">
                    <p class="fs--2 text-black m-0 text-600">
                        : {{ date_format($tr->created_at, 'd M Y H:i:s') }}
                    </p>
                </div>
            </div>
            <div class="row align-items-center mt-4">
    
                <div class="col-4">
                    <p class="fs--2 text-danger fw-bold m-0 text-600">TYPE</p>
                </div>
                <div class="col-2">
                    <p class="fs--2 text-danger fw-bold m-0 text-600">AMT</p>
                </div>
                <div class="col-3 text-end">
                    <p class="fs--2 text-danger fw-bold m-0 text-600">PRICE</p>
                </div>
                <div class="col-3 text-end">
                    <p class="fs--2 text-danger text-end fw-bold m-0 text-600">TOTAL</p>
                </div>
            </div>
            <hr class="tebal mt-2 mb-2" style="height:1px;border-width:0;color:gray;background-color:gray">
            @forelse ($tr->detail as $item)
            <div class="row align-items-center mt-3 mb-3">
                <div class="col-4">
                    <p class="fs--2 text-danger fw-bold m-0 text-600">{{ $item->Type->nama_type }}</p>
                </div>
                <div class="col-2">
                    <p class="fs--2 text-danger fw-bold m-0 text-600">{{ $item->berat }}</p>
                </div>
                <div class="col-3 text-end">
                    <p class="fs--2 text-danger fw-bold m-0 text-600">{{ number_format($item->Type->price, 0, ',', '.') }}
                    </p>
                </div>
                <div class="col-3 text-end">
                    <p class="fs--2 text-danger text-end fw-bold m-0 text-600">
                        {{ number_format($item->total, 0, ',', '.') }}</p>
                </div>
            </div>
            <hr class="tebal mt-2 mb-2" style="height:1px;border-width:0;color:gray;background-color:gray">
    
            @empty
    
            @endforelse
    
            <div class="row">
                <div class="col-6 text-start">
                    <h6 class="m-0 fs--2 text-600">Total (Rp.)</h6>
                </div>
                <div class="col-6 text-end">
                    <p class="fs--2 fw-bold m-0 text-end ps-4 text-600" id="total">
                        {{ number_format($tr->total, 0, ',', '.') }}</p>
                </div>
            </div>
            <div class="mt-6">
    
    
            </div>
            <p class="text-600 fs--2 text-center m-0 justify">
                THANK YOU FOR TRANSACTING WITH RIASTA LAUNDRY & DRY
                PLEASE CHECK YOUR CASH AND TRANSACTION BEFORE LEAVING.
            </p>
            <div class="mt-4" style="border-top: 1px dotted rgb(189, 189, 189);"></div>
        </section>
        {{-- PAGE 2----------------------------------------------------------------- --}}
        <section class="page_dua mt-2 pt-0">
            <div class="row align-items-center  text-center mb-3 mt-3">

                <div class="col-sm-12 text-center mt-3">
                    <h6 class="text-danger fw-bold m-0 ">RIASTA LAUNDRY & DRY</h6>
                    <p class="fs--2 text-black m-0 text-600">PADMA UTARA, KUTA-BALI</p>
                    <p class="fs--2 text-black m-0 text-600">PHONE: (0361) 4756405</p>
                </div>
            </div>
            <hr class="tebal mb-2" style="height:0.3px;border-width:0;color:gray;background-color:gray">
            <div class="row">
                <div class="col-3">
                    <h6 class="m-0 fs--2 text-600">Name</h6>
                </div>
                <div class="col-9">
                    <p class="fs--2 text-black m-0 text-600">: {{ $tr->nama_customer }}</p>
                </div>
            </div>
            <div class="row mt-0">
                <div class="col-3">
                    <h6 class="m-0 fs--2 text-600">Alamat</h6>
                </div>
                <div class="col-9">
                    <p class="fs--2 text-black m-0 text-600">: {{ $tr->alamat ?? "-" }}</p>
                </div>
            </div>
            <div class="row mt-0">
                <div class="col-3">
                    <h6 class="m-0 fs--2 text-600">Date</h6>
                </div>
                <div class="col-9">
                    <p class="fs--2 text-black m-0 text-600">
                        : {{ date_format($tr->created_at, 'd M Y H:i:s') }}
                    </p>
                </div>
            </div>
            <div class="row align-items-center mt-4">
    
                <div class="col-4">
                    <p class="fs--2 text-danger fw-bold m-0 text-600">TYPE</p>
                </div>
                <div class="col-2">
                    <p class="fs--2 text-danger fw-bold m-0 text-600">AMT</p>
                </div>
                <div class="col-3 text-end">
                    <p class="fs--2 text-danger fw-bold m-0 text-600">PRICE</p>
                </div>
                <div class="col-3 text-end">
                    <p class="fs--2 text-danger text-end fw-bold m-0 text-600">TOTAL</p>
                </div>
            </div>
            <hr class="tebal mt-2 mb-2" style="height:1px;border-width:0;color:gray;background-color:gray">
            @forelse ($tr->detail as $item)
            <div class="row align-items-center mt-3 mb-3">
                <div class="col-4">
                    <p class="fs--2 text-danger fw-bold m-0 text-600">{{ $item->Type->nama_type }}</p>
                </div>
                <div class="col-2">
                    <p class="fs--2 text-danger fw-bold m-0 text-600">{{ $item->berat }}</p>
                </div>
                <div class="col-3 text-end">
                    <p class="fs--2 text-danger fw-bold m-0 text-600">{{ number_format($item->Type->price, 0, ',', '.') }}
                    </p>
                </div>
                <div class="col-3 text-end">
                    <p class="fs--2 text-danger text-end fw-bold m-0 text-600">
                        {{ number_format($item->total, 0, ',', '.') }}</p>
                </div>
            </div>
            <hr class="tebal mt-2 mb-2" style="height:1px;border-width:0;color:gray;background-color:gray">
    
            @empty
    
            @endforelse
    
            <div class="row">
                <div class="col-6 text-start">
                    <h6 class="m-0 fs--2 text-600">Total (Rp.)</h6>
                </div>
                <div class="col-6 text-end">
                    <p class="fs--2 fw-bold m-0 text-end ps-4 text-600" id="total">
                        {{ number_format($tr->total, 0, ',', '.') }}</p>
                </div>
            </div>
            <div class="mt-6">
    
    
            </div>
            <p class="text-600 fs--2 text-center m-0 justify">
                THANK YOU FOR TRANSACTING WITH RIASTA LAUNDRY & DRY
                PLEASE CHECK YOUR CASH AND TRANSACTION BEFORE LEAVING.
            </p>
            <div class="mt-4" style="border-top: 1px dotted rgb(189, 189, 189);"></div>
        </section>
       
    </main>



    <script>
        $(document).ready(function () {

        });
    </script>

    {{-- <script src="sweetalert2.all.min.js"></script> --}}
    <script src="/../../falcon/vendors/choices/choices.min.js"></script>
    <script src="/../../falcon/vendors/popper/popper.min.js"></script>
    <script src="/../../falcon/vendors/bootstrap/bootstrap.min.js"></script>
    <script src="/../../falcon/vendors/anchorjs/anchor.min.js"></script>
    <script src="/../../falcon/vendors/is/is.min.js"></script>
    <script src="/../../falcon/vendors/echarts/echarts.min.js"></script>
    <script src="/../../falcon/vendors/fontawesome/all.min.js"></script>
    <script src="/../../falcon/vendors/lodash/lodash.min.js"></script>
    <script src="/../../falcon/vendors/list.js/list.min.js"></script>
    <script src="/../../falcon/assets/js/theme.js"></script>
    <script src="/../../falcon/assets/js/theme.js"></script>
    <script src="/../../falcon/assets/js/config.js"></script>

</body>


</html>