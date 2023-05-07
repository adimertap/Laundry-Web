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
                            <p>Tambah Data Master Jenis Customer Disini</p>
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
                            <h6 class="mb-md-0 mb-lg-2">Total Jenis</h6><span
                                class="badge rounded-pill badge-soft-success">Jenis Customer</span>
                        </div>
                        <div class="col-auto">
                            <h5 class="fs-2 fw-normal text-700"><span>{{ $count }}</span> Jenis Customer</h4>
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
                    <h5 class="mb-0 m-0" data-anchor="data-anchor">Data Jenis</h5>
                    <p class="mb-0 pt-1 mt-2 mb-0">Manajemen Data Jenis Customer</p>
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
                                <th class="sort text-center" data-sort="country">Nama Jenis</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            @forelse ($jenis as $item)
                            <tr role="row" class="odd">
                                <th scope="row" class="no">{{ $loop->iteration}}.</th>
                                <td class="nama_type">{{ $item->nama_kategori_penerima }}</td>
                                <td class="text-center">
                                    <button class="btn p-0 ms-2 editJenis" value="{{ $item->id_category_penerima }}" type="button"
                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                        data-id-type="{{ $item->id_category_penerima }}" title="Edit"><span
                                            class="text-700 fas fa-edit"></span>
                                    </button>
                                    <button class="btn p-0 ms-2 deleteJenis" value="{{ $item->id_category_penerima }}" type="button"
                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                        data-id-type="{{ $item->id_category_penerima }}" title="Delete"><span
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
            <form action="{{ route('laundry-jenis.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body p-0">
                    <div class="rounded-top-lg py-3 ps-4 pe-6 bg-light">
                        <h5 class="mb-1">Tambah Data Jenis Customer</h5>
                    </div>
                    <div class="p-4 pb-0">
                        <div class="d-flex justify-content-between">
                            <p class="text-word-break fs--1">Lengkapi Form Jenis Customer berikut ini</p>
                            <div class="mb-1">
                                <span style="color: red">*</span> <span class="fs--1">Wajib diisi</span>
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label class="form-label" for="nama_kategori_penerima">Nama Jenis</label><span class="mr-4 mb-3"
                                style="color: red">*</span>
                            <input class="form-control @error('nama_kategori_penerima') is-invalid @enderror" name="nama_kategori_penerima"
                                type="text" placeholder="Input Nama Jenis Penerima" value="{{ old('nama_kategori_penerima') }}"
                                required />
                            @error('nama_kategori_penerima')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
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
            <form action="{{ route('deleteJenis') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body p-0">
                    <div class="bg-danger rounded-top-lg py-3 ps-4 pe-6">
                        <h4 class="mb-1 text-white">Hapus Data Jenis Customer</h4>
                    </div>
                    <div class="p-3">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="d-flex">
                                    <div class="flex-1">
                                        <input type="hidden" name="category_penerima_id" id="category_penerima_id">
                                        <h5 class="mb-2 fs-0">Confirmation</h5>
                                        <p class="text-word-break fs--1">Apakah Anda Yakin Menghapus Data Jenis Customer ini?
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
            <form id="editForm" action="{{ route('updateJenis') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id_category_penerima" id="id_category_penerima" value="">
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
                            <label class="form-label" for="nama_kategori_penerima">Nama Jenis</label><span class="mr-4 mb-3"
                                style="color: red">*</span>
                            <input class="form-control" name="editNama" id="editNama" type="text"
                                placeholder="Input Nama Jenis Customer" value="{{ old('nama_kategori_penerima') }}" required />
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
    $(document).ready(function () {
        @if(session('show_modal'))
            setTimeout(function() {
                $('#modal-tambah').modal('show');
            }, 500);
        @endif
        
        var table = $('#datatable').DataTable();
        table.on('click', '.editJenis', function () {
            $('#modal-edit').modal('show');
            var id = $(this).val();
            $('#id_category_penerima').val(id)

            $tr = $(this).closest('tr');
            if ($($tr).hasClass('clid')) {
                $tr = $tr.prev('.parent')
            }
            var data = table.row($tr).data();
            var nama = data[1]
            $('#editNama').val(nama)
        })

        table.on('click', '.deleteJenis', function () {
            $('#modal-delete').modal('show');
            var id = $(this).val();
            $('#category_penerima_id').val(id)
        })
    });

</script>



@endsection