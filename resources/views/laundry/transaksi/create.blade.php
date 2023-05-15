@extends('layouts.app')

@section('content')
<main>
    <div class="card bg-light mb-3">
        <div class="bg-holder d-none d-lg-block bg-card"
            style="background-image:url(../../../assets/img/icons/spot-illustrations/corner-4.png);opacity: 0.7;"></div>
        <!--/.bg-holder-->
        <div class="card-body position-relative">
            <div class="d-flex justify-content-between">
                <div>
                    <h5>Buat Transaksi Laundry Baru</h5>
                    <p class="fs--1">Inputkan Transaksi Laundry Anda disini</p>
                    <div><strong class="me-2">Status: </strong>
                        <div class="badge rounded-pill badge-soft-success fs--2">Laundry Baru
                            <span class="fas fa-check ms-1" data-fa-transform="shrink-2"></span>
                        </div>
                    </div>
                </div>
                <div class="mt-2">
                    <p class="fs--1">{{ $today }}</p>
                </div>
            </div>

        </div>
    </div>
    <form action="{{ route('transaksi-laundry.store') }}" id="form" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-4">
                <div class="card">
                    <div class="card-header">
                        <p class="text-word-break fs--1">Lengkapi Form Laundry berikut ini</p>
                    </div>
                    <div class="card-body pt-1">
                        <input type="hidden" value="{{ $idbaru }}" id="id_transaksi" />
                        <div class="row mt-2">
                            <div class="col-6">
                                <label class="form-label" for="tanggal">Tanggal Transaksi</label><span class="mr-4 mb-3"
                                    style="color: red">*</span>
                                <input class="form-control form-select-sm  @error('tanggal') is-invalid @enderror"
                                    name="tanggal" type="date" placeholder="Input Tanggal Transaksi" value="{{ $sekarang }}"
                                    required />
                                @error('tanggal')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="status_paid">Status Bayar</label><span class="mr-4 mb-3"
                                    style="color: red">*</span>
                                <select class="form-select form-select-sm" id="status_paid" size="1"
                                    name="status_paid"
                                    data-options='{"removeItemButton":true,"placeholder":true,"shouldSort":false}'>
                                    <option value="unpaid">Belum</option>
                                    <option value="paid">Terbayar</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 mt-2">
                            <label for="jenis">Pilih Jenis Customer</label><span class="mr-4 mb-3"
                                style="color: red">*</span>
                            <select class="form-select form-select-sm" id="jenisCustomer" size="1"
                                name="id_category_penerima"
                                data-options='{"removeItemButton":true,"placeholder":true,"shouldSort":false}'>
                                <option value="">Pilih Jenis Terlebih Dahulu</option>
                                @foreach ($jenis as $item)
                                <option value="{{ $item->id_category_penerima }}">{{ $item->nama_kategori_penerima }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 mt-2">
                            <label class="form-label" for="nama_customer">Nama Customer</label><span class="mr-4 mb-3"
                                style="color: red">*</span>
                            <input class="form-control form-select-sm  @error('nama_customer') is-invalid @enderror"
                                name="nama_customer" type="text" placeholder="Input Nama Customer"
                                value="{{ old('nama_customer') }}" required />
                            @error('nama_customer')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>
                        <div class="col-12 mt-2">
                            <label class="form-label" for="nomor_telephone">Nomor Telephone</label>
                            <input class="form-control form-select-sm @error('nomor_telephone') is-invalid @enderror"
                                name="nomor_telephone" type="number" value="{{ old('nomor_telephone') }}"
                                placeholder="Input Nomor Telephone Customer" />
                            @error('nomor_telephone')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>
                        <div class="col-12 mt-2">
                            <label class="form-label" for="alamat">Alamat Customer</label>
                            <textarea class="form-control form-select-sm @error('alamat') is-invalid @enderror"
                                name="alamat" type="text" value="{{ old('alamat') }}" id="alamat"
                                placeholder="Input Alamat Customer" rows="4"></textarea>
                            @error('alamat')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-center bg-light">
                        <button class="btn btn-primary" id="btnSimpan" type="button" onclick="simpanData(event)">Simpan
                            Transaksi</button>
                    </div>
                </div>
            </div>
            <div class="col-8">
                <div class="card">
                    <div class="card-header bg-light btn-reveal-trigger d-flex flex-between-center">
                        <p class="text-word-break fs--1">Order Customer</p>
                        <a class="btn btn-falcon-default btn-sm" type="button" data-bs-toggle="modal"
                            data-bs-target="#modaltambah">
                            <span class="fas fa-plus me-2" data-fa-transform="shrink-2"></span>Tambah
                            Transaksi</a>
                    </div>
                    <div class="card-body">
                        {{-- <h6 class="text-primary">Nomor Order: #{{ $kode_transaksi }}</h6>
                        <input type="hidden" name="kode_transaksi" value="{{ $kode_transaksi }}">
                        <input type="hidden" name="tanggal_transaksi" value="{{ $today_format }}">
                        <input type="hidden" name="id_modal" value="{{ $modal->id_modal }}">
                        <input type="hidden" name="id_transaksi" value="{{ $idbaru }}"> --}}

                        <div id="tableExample"
                            data-list='{"valueNames":["no","pegawai","tanggal_transaksi","kode_transaksi","total"],"page":20,"pagination":true}'>
                            <div class="table-responsive scrollbar">
                                <table id="dataTableKonfirmasi" class="table table-striped" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Type</th>
                                            <th>Harga</th>
                                            <th>Berat</th>
                                            <th>Total</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="konfirmasi">

                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                    <div class="card-footer bg-light">
                        <div class="d-flex justify-content-between">
                            <div class="fw-semi-bold fs--1">Total Berat</div>
                            <div class="fw-bold berat_total" id="berat_total">0 KG</div>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mt-2">
                            <div class="fw-semi-bold fs--1">Total Dibayarkan</div>
                            <div class="fw-bold payable_total" id="payable_total">Rp. 0.0</div>
                        </div>
                    </div>
                   
                </div>
            </div>
        </div>
    </form>
</main>

<div class="modal fade" id="modaltambah" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px">
        <div class="modal-content position-relative">
            <div class="modal-header px-5 position-relative modal-shape-header bg-shape">
                <div class="position-relative z-index-1 light">
                    <h4 class="mb-0 text-white" id="authentication-modal-label">Tambah Transaksi</h4>
                    <p class="fs--1 mb-0 text-white">Tambah detail transaksi untuk melengkapi Order</p>
                </div><button class="btn-close btn-close-white position-absolute top-0 end-0 mt-2 me-2"
                    id="btn-close-modal" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="#" id="form1" method="POST">
                @csrf
                <div class="modal-body p-0">
                    <div class="p-4 pb-0">
                        <p class="text-word-break fs--1">Lengkapi Form berikut ini</p>
                        <div class="border-dashed-bottom mb-2"></div>
                        <div class="row mb-3">
                            <div class="col-12">
                                <label for="type" class="small">Pilih Type</label><span class="mr-4 mb-3"
                                    style="color: red">*</span>
                                <select class="form-select js-choice type-select" id="type" size="1" name="type"
                                    data-options='{"removeItemButton":true,"placeholder":true,"shouldSort":false}'>
                                    <option value="">Pilih Type Terlebih Dahulu</option>
                                    @foreach ($type as $item)
                                    <option value="{{ $item->id_type }}">{{ $item->nama_type }}: {{
                                        number_format($item->price) }}/KG</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <label class="form-label small" for="berat">Berat KG</label><span class="mr-4 mb-3"
                                    style="color: red">*</span>
                                <input class="form-control berat" id="berat" name="berat" type="number"
                                    placeholder="Berat" value="{{ old('berat') }}" required />
                            </div>
                            <div class="col-9">
                                <label class="form-label small" for="total">Total</label>
                                <div class="input-group"><span class="input-group-text">Rp. </span>
                                    <input class="form-control total" id="total" name="total"
                                        placeholder="Otomatis Terhitung" value="{{ old('total') }}" readonly />
                                </div>
                            </div>
                        </div>
                        <p class="fs--1 mt-3 mb-0"> <b>Ket:</b></p>
                        <p class="fs--1 m-0 mt-0">- Harga Total akan otomatis terisi setelah memilih Type</p>
                        <p class="fs--1 m-0 mt-0">- Jika berat terdapat koma (,) ganti dengan titik (.) contoh 1.5 </p>
                    </div>
                </div>
                <div class="modal-footer mt-4 p-3">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="button" onclick="tambahdata(event)">Tambah </button>
                </div>
            </form>
        </div>
    </div>
</div>

<template id="template_delete_button">
    <button class="btn p-0" onclick="hapusdata(this)" type="button"><span class="text-700 fas fa-trash-alt"></span>
    </button>
</template>

<script>
    $(document).ready(function () {
        $('.berat').each(function () {
            $(this).on('input', function () {
                var berat = $(this).val()
                var selectedOption = $('#type').find(':selected');
                var priceText = selectedOption.text().split(': ')[1];
                var price = parseFloat(priceText.replace(/,/g, ''));
                var price_fix = new Intl.NumberFormat('id', {
                    minimumFractionDigits: 0,
                }).format(price * berat)
                $('#total').val(price_fix)
            })
        })

        var template = $('#template_delete_button').html()
        $('#dataTableKonfirmasi').DataTable({
            "paging": false,
            "ordering": false,
            "info": false,
            "searching": false,
            "columnDefs": [{
                    "targets": -1,
                    "data": null,
                    "defaultContent": template
                },
                {
                    "targets": 0,
                    "data": null,
                    'render': function (data, type, row, meta) {
                        return meta.row + 1
                    }
                }
            ]
        });
    });

    function hapusdata(element) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                var table = $('#dataTableKonfirmasi').DataTable()
                var row = $(element).parent().parent()
                table.row(row).remove().draw();
                var table = $('#dataTable').DataTable()

                var jumlah = $(row.children()[4]).text()
                var jumlah_trim = jumlah.split('Rp')[1].replace('.', '').replace('.', '').trim()

                // PAYABLE 
                var payable_total = $('#payable_total').html()
                var payable_total_trim = payable_total.split('Rp&nbsp;')[1].replace('.', '').replace('.', '')
                    .trim()
                var payable_total_fix = parseInt(payable_total_trim) - parseInt(jumlah_trim)
                var payable_total_idr = new Intl.NumberFormat('id', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0,
                }).format(payable_total_fix)
                $('#payable_total').html(payable_total_idr)

                var total_berat_1 = $('#berat_total').html().replace(' KG', '').trim()
                var temp_berat = $(row.children()[3]).text()
                var temp_berat_2 = temp_berat.replace(' KG', '').trim()
                var temp_berat_fix = parseFloat(total_berat_1) - parseFloat(temp_berat_2)
                $('#berat_total').html(temp_berat_fix + " KG")

            }
        })
    }

    function simpanData(event) {
        event.preventDefault()
        var selectedOption = $('#jenisCustomer').find(':selected');
        var jenis = selectedOption.text()

        var form = $('#form')
        var _token = form.find('input[name="_token"]').val()
        var nama = form.find('input[name="nama_customer"]').val()
        var phone = form.find('input[name="nomor_telephone"]').val()
        var alamat = $('#alamat').val()
        var status_paid = $('#status_paid').val()
        var tanggal = form.find('input[name="tanggal"]').val()
        var id_category = $('#jenisCustomer').val()
        var dataform2 = []
        var temp_total = $('#payable_total').html()
        var grand_total = temp_total.split('Rp&nbsp;')[1].replace('.', '').replace('.', '').trim()
        var total_berat = $('#berat_total').html().replace(' KG', '').trim()


        if (jenis == "Pilih Jenis Terlebih Dahulu") {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Pilih Jenis Customer Dahulu',
            })
        } else if (nama == null || !nama || nama == "") {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Nama Customer Tidak Boleh Kosong',
            })
        } else {
            var detail = $('#konfirmasi').children()
            for (let index = 0; index < detail.length; index++) {
                var children = $(detail[index]).children()

                if (children.html() == 'No data available in table') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Transaksi Kosong!, Isi Transaksi Terlebih Dahulu',
                    })
                } else {
                    var td_currency = children[1]
                    var span = $(td_currency).children()[0]
                    var id_type = $(span).attr('id')

                    var td_harga = children[2]
                    var td_harga_trim = $(td_harga).html()
                    var harga_satuan = td_harga_trim.split('Rp&nbsp;')[1].replace(',', '.').replace('.', '')
                        .trim()

                    var td_berat = children[3]
                    var berat = $(td_berat).html().replace('KG', '').trim()

                    var td_total = children[4]
                    var td_total_trim = $(td_total).html()
                    var total = td_total_trim.split('Rp&nbsp;')[1].replace(',', '.').replace('.', '').replace('.',
                        '').trim()

                    var id_transaksi = $('#id_transaksi').val()    

                    dataform2.push({
                        id_transaksi: id_transaksi,
                        id_type: id_type,
                        harga_kg: harga_satuan,
                        berat: berat,
                        total: total
                    })
                }
            }

            if (dataform2.length == 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Transaksi Kosong!, Isi Transaksi Terlebih Dahulu',
                })
            } else {
                var data = {
                    _token: _token,
                    id_category: id_category,
                    nama_customer: nama,
                    phone: phone,
                    alamat: alamat,
                    tanggal_transaksi: tanggal,
                    total: grand_total,
                    total_berat: total_berat,
                    status_paid:status_paid,
                    detail: dataform2
                }
                console.log(data)
                var id_transaksi = $('#id_transaksi').val()    
                $.ajax({
                    method: 'post',
                    url: '/transaksi-laundry',
                    data: data,
                    beforeSend: function () {
                        $('#btnSimpan').prop('disabled', true);
                    },
                    success: function (response) {
                        // window.location.href = '/transaksi-laundry/create'
                        window.open(
                            '/laundry-cetak/' + id_transaksi,
                            '_blank'
                        );

                        window.location.reload();

                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })

                        Toast.fire({
                            icon: 'success',
                            title: 'Data Masih Diproses Mohon Tunggu'
                        })
                    },
                    error: function (response) {
                        console.log(response)
                        $('#btnSimpan').prop('disabled', false);
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Error! Transaksi Tidak dapat disimpan, Hubungi Developer',
                        })
                    },
                    complete: function(){
                        $('#btnSimpan').prop('disabled', false);
                    }
                });
            }
        }

    }

    function tambahdata(event) {
        var id_type = $('#type').val()
        var table = $('#dataTableKonfirmasi').DataTable()
        var row = $(`#${id_type.trim()}`).parent().parent()
        if(row.length > 0){
            Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Type tersebut telah ada! hapus dahulu dan tambahkan ulang',
                })
                $('#modaltambah').modal('hide')
                $('#form1')[0].reset();
        }else{
            var selectedOption = $('#type').find(':selected');
        var text = selectedOption.text();
        if (text == "Pilih Type Terlebih Dahulu") {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Pilih Type Laundry Dahulu',
            })
        } else {
            var priceText = selectedOption.text().split(': ')[1];
            var type = selectedOption.text().split(': ')[0];
            var price = parseFloat(priceText.replace(/,/g, ''));
            var price_fix = new Intl.NumberFormat('id', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0,
            }).format(price)
            var berat = $('#berat').val()

            if (berat == null || berat == "" || berat <= 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Input Berat Terlebih Dahulu dan tidak boleh 0',
                })
            } else {
                var total = $('#total').val()
                var total_fix = new Intl.NumberFormat('id', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0,
                }).format(price * berat)

                var check_berat = $('#berat_total').html()
                if(check_berat == "0 KG"){
                    var temp_berat = 0 + parseFloat(berat)
                }else{
                    var temp_berat = parseFloat(check_berat.replace(' KG', '').trim()) + parseFloat(berat)
                }
                $('#berat_total').html(temp_berat + " KG")

                var payable_total = $('#payable_total').html()
                var check_payable = payable_total.includes("Rp.");
                if (check_payable == true) {
                    var payable_total_trim = payable_total.split('Rp')[1].replace('.', '').replace('.', '').trim()
                    var payable_total_fix = parseInt(payable_total_trim) + (price * berat)
                } else {
                    var payable_total_trim = payable_total.split('Rp&nbsp;')[1].replace('.', '').replace('.', '').trim()
                    var payable_total_fix = parseInt(payable_total_trim) + parseInt(price * berat)
                }
                var payable_total_idr = new Intl.NumberFormat('id', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0,
                }).format(payable_total_fix)
                $('#payable_total').html(payable_total_idr)


               

                // table.row(row).remove().draw();

                // DRAW DATATABLE
                $('#dataTableKonfirmasi').DataTable().row.add([
                    berat, `<span id=${id_type}>${type}</span>`, price_fix, berat + " KG",
                    total_fix, total
                ]).draw();

                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })

                Toast.fire({
                    icon: 'success',
                    title: 'Berhasil Menambahkan Laundry'
                })
                $('#form1')[0].reset();
                $('#modaltambah').modal('hide')
            }
        }
        }

       
    }
</script>



@endsection