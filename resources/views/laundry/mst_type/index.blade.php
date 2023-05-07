@extends('layouts.app')

@section('content')
<main>
    <div class="row g-3 mb-3 mt-3">
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-body">
                    <div class="row flex-between-center g-0">
                        <div class="col-8 d-lg-block flex-between-center">
                            <h5 class="text-primary mb-1">Tambah Data!</h5>
                            <p>Tambah Data Master Type dan harga Disini</p>
                        </div>
                        <div class="col-auto h-100">
                            <button class="btn btn-sm btn-primary" type="button" data-bs-toggle="modal" id="btnTambah"
                                data-bs-target="#modal-tambah">Tambah Data</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-body">
                    <div class="row flex-between-center">
                        <div class="col d-md-flex d-lg-block flex-between-center">
                            <h6 class="mb-md-0 mb-lg-2">Total Type</h6><span
                                class="badge rounded-pill badge-soft-success">Type Laundry</span>
                        </div>
                        <div class="col-auto">
                            <h5 class="fs-2 fw-normal text-700"><span>{{ $count }}</span> Type Laundry</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-header">
            <div class="row flex-between-end">
                <div class="col-auto align-self-center">
                    <h5 class="mb-0 m-0" data-anchor="data-anchor">Data Type</h5>
                    <p class="mb-0 pt-1 mt-2 mb-0">Manajemen Data Type dan harga</p>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div id="tableType"
                data-list='{"valueNames":["no","nama_type","harga", "keterangan"],"page":20,"pagination":true}'>
                <div class="table-responsive scrollbar">
                    <table class="table table-bordered table-striped fs--1 mb-0" id="datatable">
                        <thead class="bg-200 text-900">
                            <tr>
                                <th class="sort text-center" data-sort="no">No.</th>
                                <th class="sort text-center" data-sort="country">Nama Type</th>
                                <th class="sort text-center" data-sort="jenis">Harga</th>
                                <th class="sort text-center" data-sort="kurs">Keterangan</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            @forelse ($type as $item)
                            <tr role="row" class="odd">
                                <input type="hidden" name="_token" id="token_edit" value="{{ csrf_token() }}">
                                <th scope="row" class="no">{{ $loop->iteration}}.</th>
                                <td class="nama_type">{{ $item->nama_type }}</td>
                                <td class="harga"> {{ number_format($item->price, 0, ',', '.') }} / Kg</td>
                                @if(!$item->keterangan)
                                <td class="keterangan">-</td>
                                @else
                                <td class="keterangan">{{ $item->keterangan }}</td>
                                @endif

                                <td class="text-center">
                                    <button class="btn p-0 ms-2 editType" value="{{ $item->id_type }}" type="button"
                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                        data-id-type="{{ $item->id_type }}" title="Edit"><span
                                            class="text-700 fas fa-edit"></span>
                                    </button>
                                    <button class="btn p-0 ms-2 deleteType" value="{{ $item->id_type }}" type="button"
                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                        data-id-type="{{ $item->id_type }}" title="Delete"><span
                                            class="text-700 fas fa-trash-alt"></span>
                                    </button>

                                </td>
                            </tr>

                            @empty

                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

</main>

<div class="modal fade" id="modal-tambah" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1"
    role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px">
        <div class="modal-content position-relative">
            <div class="position-absolute top-0 end-0 mt-2 me-2 z-index-1">
                <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base"
                    data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('laundry-type.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body p-0">
                    <div class="rounded-top-lg py-3 ps-4 pe-6 bg-light">
                        <h5 class="mb-1">Tambah Data Type dan Harga</h5>
                    </div>
                    <div class="p-4 pb-0">
                        <div class="d-flex justify-content-between">
                            <p class="text-word-break fs--1">Lengkapi Form Type dan Harga berikut ini</p>
                            <div class="mb-1">
                                <span style="color: red">*</span> <span class="fs--1">Wajib diisi</span>
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label class="form-label" for="nama_type">Nama Type</label><span class="mr-4 mb-3"
                                style="color: red">*</span>
                            <input class="form-control @error('nama_type') is-invalid @enderror" name="nama_type"
                                type="text" placeholder="Input Nama Type Laundry" value="{{ old('nama_type') }}"
                                required />
                            @error('nama_type')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-1">
                            <label class="form-label" for="price">Harga Per Kg</label><span class="mr-4 mb-3"
                                style="color: red">*</span>
                            <input class="form-control @error('price') is-invalid @enderror" name="price" type="number"
                                placeholder="Input Harga Type" step='0.01' id="price" value="{{ old('price') }}"
                                required />
                            @error('price')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>
                        <p class="text-primary m-b-3 fs--1">(IDR):
                            <span id="detailjumlahcurrency" class="detailjumlahcurrency">

                            </span>
                        </p>
                        <div class="col-md-12 mb-4">
                            <label class="form-label" for="keterangan">Keterangan</label>
                            <textarea class="form-control" name="keterangan" type="text" placeholder="Input Keterangan"
                                value="{{ old('country') }}"></textarea>
                            <span class="mb-4" *</span> <span class="fs--1"> -Keterangan untuk Type dan Harga</span>
                        </div>
                        @if ($errors->any())
                        <div class="alert alert-danger small">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-between p-3 mt-2">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="submit">Tambah Data </button>
                </div>
            </form>
        </div>
    </div>
</div>



<div class="modal fade" id="modal-delete" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0">
            <div class="position-absolute top-0 end-0 mt-3 me-3 z-index-1"><button
                    class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base" data-bs-dismiss="modal"
                    aria-label="Close"></button></div>
            <form action="{{ route('deleteType') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body p-0">
                    <div class="bg-danger rounded-top-lg py-3 ps-4 pe-6">
                        <h4 class="mb-1 text-white">Hapus Data Type</h4>
                    </div>
                    <div class="p-3">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="d-flex">
                                    <div class="flex-1">
                                        <input type="hidden" name="type_id" id="type_id">
                                        <h5 class="mb-2 fs-0">Confirmation</h5>
                                        <p class="text-word-break fs--1">Apakah Anda Yakin Menghapus Data Type ini?
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary btn-sm" type="button" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-danger btn-sm" type="submit">Yes! Delete </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-edit" data-bs-keyboard="false"
    data-bs-backdrop="static" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px">
        <div class="modal-content position-relative">
            <div class="position-absolute top-0 end-0 mt-2 me-2 z-index-1">
                <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base"
                    data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editForm" action="{{ route('updateType') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id_type" id="id_type" value="">
                <div class="modal-body p-0">
                    <div class="rounded-top-lg py-3 ps-4 pe-6 bg-light">
                        <h5 class="mb-1">Edit Data Type dan Harga</h5>
                    </div>
                    <div class="p-4 pb-0">
                        <div class="d-flex justify-content-between">
                            <p class="text-word-break fs--1">Lengkapi Form Type dan Harga berikut ini</p>
                            <div class="mb-1">
                                <span style="color: red">*</span> <span class="fs--1">Wajib diisi</span>
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label class="form-label" for="nama_type">Nama Type</label><span class="mr-4 mb-3"
                                style="color: red">*</span>
                            <input class="form-control" name="editNama" id="editNama" type="text"
                                placeholder="Input Nama Type Laundry" value="{{ old('nama_type') }}" required />
                        </div>
                        <div class="col-md-12 mb-1">
                            <label class="form-label" for="price">Harga Per Kg</label><span class="mr-4 mb-3"
                                style="color: red">*</span>
                            <input class="form-control" name="editPrice" type="number" placeholder="Input Harga Type"
                                step='0.01' id="editPrice" value="{{ old('price') }}" required />
                        </div>
                        <p class="text-primary m-b-3 fs--1">(IDR):
                            <span class="editPriceDynamic">

                            </span>
                        </p>
                        <div class="col-md-12 mb-4">
                            <label class="form-label" for="keterangan">Keterangan</label>
                            <textarea class="form-control" name="editKeterangan" type="text"
                                placeholder="Input Keterangan" value="{{ old('keterangan') }}"
                                id="editKeterangan"></textarea>
                            <span class="mb-4" *</span> <span class="fs--1"> -Keterangan untuk Type dan Harga</span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-between p-3 mt-2">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary" id="editButton" type="submit">Edit Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    // function edit_data(event) {
    //     event.preventDefault()
    //     var form = $('#editForm')
    //     var _token = form.find('input[name="_token"]').val()
    //     var id_type = form.find('input[name="id_type"]').val()
    //     var nama_type = form.find('input[name="editNama"]').val()
    //     var price = form.find('input[name="editPrice"]').val()
    //     var keterangan = $('#editKeterangan').val()
    //     if(nama_type == ""){
    //         Swal.fire({
    //                 icon: 'error',
    //                 title: 'Oops...',
    //                 text: 'Field Nama Type tidak boleh kosong',
    //             })
    //     }else if(price == ""){
    //         Swal.fire({
    //                 icon: 'error',
    //                 title: 'Oops...',
    //                 text: 'Field Price tidak boleh kosong',
    //             })
    //     }else{
    //         var data = {
    //             _token: _token,
    //             id_type: id_type,
    //             nama_type: nama_type,
    //             price: price,
    //             keterangan: keterangan
    //         }
    //         console.log(data)

    //     $('#editButton').prop('disabled', true);
    //     $('#editButton').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...');

    //     $.ajax({
    //         method: 'POST',
    //         url: '/owner/laundry-type/update',
    //         // url: `{{ route('laundry-type.update', ':id_type') }}`.replace(':id_type', id_type),
    //         data: data,
    //         contentType: "application/json",
    //         success: function(response) {
    //             window.location.reload()

    //             const Toast = Swal.mixin({
    //                 toast: true,
    //                 position: 'top-end',
    //                 showConfirmButton: false,
    //                 timer: 1000,
    //                 timerProgressBar: true,
    //                 didOpen: (toast) => {
    //                     toast.addEventListener('mouseenter', Swal.stopTimer)
    //                     toast.addEventListener('mouseleave', Swal.resumeTimer)
    //                 }
    //             })

    //             Toast.fire({
    //                 icon: 'success',
    //                 title: 'Data Masih Diproses Mohon Tunggu'
    //             })
              
    //         },
    //         error: function(response) {
    //             console.log(response)
    //             $('#editButton').prop('disabled', false).html("Edit");

    //             Swal.fire({
    //                 icon: 'error',
    //                 title: 'Oops...',
    //                 text: 'Error! Master Tidak dapat disimpan, Hubungi Developer',
    //             })
    //         }
    //     });
    //     }

        
    // };

    $(document).ready(function () {
        @if(session('show_modal'))
            setTimeout(function() {
                $('#modal-tambah').modal('show');
            }, 500);
        @endif
        
        $('.deleteCurrencyBtn').click(function (e) {
            e.preventDefault();

            var id = $(this).val();
            $('#id_currency').val(id)
            $('#deleteCurrency').modal('show');
        })

        $('#price').on('input', function() {
            var value = $(this).val() 
            var hasil_calc = new Intl.NumberFormat('id', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0,
                maximumFractionDigits: 0
            }).format(value);

            $('#detailjumlahcurrency').html(hasil_calc + " / Kg")
        });

        $('#editPrice').on('input', function() {
            var value = $(this).val() 
            var hasil_calc = new Intl.NumberFormat('id', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0,
                maximumFractionDigits: 0
            }).format(value);

            $('.editPriceDynamic').html(hasil_calc + " / Kg")
        });

        var table = $('#datatable').DataTable();
        table.on('click', '.editType', function () {
            $('#modal-edit').modal('show');
            var id = $(this).val();
            $('#id_type').val(id)

            $tr = $(this).closest('tr');
            if ($($tr).hasClass('clid')) {
                $tr = $tr.prev('.parent')
            }

            var data = table.row($tr).data();
            console.log(data[2])
            var nama = data[1]
            var harga = data[2].replace('.', '').replace(',', '').replace('/ Kg', '').trim()
            var keterangan = data[3]

            $('#editNama').val(nama)
            $('#editPrice').val(harga)
            $('#editKeterangan').val(keterangan)
            $('.editPriceDynamic').html( new Intl.NumberFormat('id', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0,
            }).format(harga))

            $('#editForm').attr('action', '/owner/laundry-type/update')
        })

        table.on('click', '.deleteType', function () {
            $('#modal-delete').modal('show');
            var id = $(this).val();
            $('#type_id').val(id)
        })
    });

</script>



@endsection