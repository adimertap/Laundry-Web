@extends('layouts.app')

@section('content')
<main>
    <div class="row g-3 mb-3 mt-3">
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="row flex-between-center g-0">
                        <div class="col-auto h-100">
                            <h6>Laporan Hari ini</h6>
                            <button class="btn btn-falcon-default btn-sm me-1 mb-2 mb-sm-0" type="button"
                                data-bs-toggle="modal" data-bs-target="#modalfilter"><span
                                    class="fas fa-arrow-down me-1"> </span>Download Laporan Hari Ini
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="mb-md-0 mb-lg-2">Total Transaksi Hari Ini</h6>
                            <span class="badge rounded-pill badge-soft-success">Rp. {{ number_format($total_transaksi)
                                }}</span>
                        </div>
                        <div>
                            <h6 class="mb-md-0 mb-lg-2">Total Proses</h6>
                            <span class="badge rounded-pill badge-soft-primary">{{ $proses }} Data</span>
                        </div>
                        <div>
                            <h6 class="mb-md-0 mb-lg-2">Total Selesai</h6>
                            <span class="badge rounded-pill badge-soft-primary">{{ $selesai }} Data</span>
                        </div>
                        <div>
                            <h6 class="mb-md-0 mb-lg-2">Total Diambil</h6>
                            <span class="badge rounded-pill badge-soft-primary">{{ $diambil }} Data</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <div class="col-auto align-self-center">
                    <h5 class="mb-0">Rekapan Data Transaksi Hari Ini {{ $today }}
                    </h5>
                    <p class="mb-0 pt-1 m-0 mt-0">Manajemen Data Transaksi</p>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div id="tableExample" class="dataTables_wrapper"
                data-list='{"valueNames":["no","pegawai","tanggal_transaksi","kode_transaksi","total"],"page":20,"pagination":true}'>
                <div class="table-responsive scrollbar">
                    <table id="example" class="table table-striped" style="width:100%">
                        <thead class="bg-200 text-900">
                            <tr>
                                <th class="sort text-center fs--1" data-sort="no">No.</th>
                                <th class="sort text-center fs--1" data-sort="tanggal_transaksi">Jam</th>
                                <th class="sort text-center fs--1" data-sort="nomor_transaksi">Pegawai</th>
                                <th class="sort text-center fs--1" data-sort="nama_customer" style="width: 100px">
                                    Customer</th>
                                <th class="sort text-center fs--1" data-sort="nomor_telephone">Phone</th>
                                <th class="sort text-center fs--1" data-sort="total_berat">Berat</th>
                                <th class="sort text-center fs--1" data-sort="total">Total</th>
                                <th class="sort text-center fs--1" data-sort="status_paid">Bayar</th>
                                <th class="sort text-center fs--1" data-sort="status">Status</th>
                                <th class="sort text-center fs--1" data-sort="print">Diambil</th>
                                <th class="text-center" style="width: 80px">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="list small">
                            @forelse ($tr as $item)
                            @php
                            $date = DateTime::createFromFormat('Y-m-d H:i:s', $item->tanggal_ambil);
                            @endphp
                            <tr role="row" class="odd">
                                <th scope="row" class="no fs--1">{{ $loop->iteration}}.</th>
                                <td class="text-center tanggal_transaksi fs--1">{{ date('H:i:s',
                                    strtotime($item->created_at)) }}</td>
                                <td class="text-center nomor_transaksi fs--1">{{ $item->Pegawai->name }}</td>
                                <td class="text-center nama_customer fs--1">{{ $item->nama_customer }}</td>
                                <td class="text-center nomor_telephone fs--1">{{ $item->nomor_telephone }}</td>
                                <td class="text-center alamat fs--1">{{ $item->total_berat }} kg</td>
                                <td class="text-center status_paid text-center fs--1">Rp.
                                    {{ number_format($item->total, 0,',', '.') }}</td>
                                    <td class="text-center status text-center fs--1">
                                        @if($item->status_paid == 'paid')
                                            <span class="badge rounded-pill badge-soft-success">Paid</span>
                                        @else
                                            <span class="badge rounded-pill badge-soft-danger">Unpaid</span>
                                        @endif
                                    </td>
                                <td class="text-center status text-center fs--1">
                                    @if($item->status == 'diambil')
                                    <span class="badge rounded-pill badge-soft-success">Diambil</span>
                                    @elseif ($item->status == 'selesai')
                                    <span class="badge rounded-pill badge-soft-success">Selesai</span>
                                    @else
                                    <span class="badge rounded-pill badge-soft-primary">Proses</span>
                                    @endif
                                </td>
                                <td class="text-center fs--1">
                                    @if($item->status == 'proses')
                                    <button class="btn btn-xs btn-light fs---1" onclick="selesaiFunction({{ $item->id_transaksi }})"
                                        value="{{ $item->id_transaksi }}"> Selesai
                                    </button>
                                    <form id="selesai-form-{{ $item->id_transaksi }}" action="{{ route('transaksi-laundry-selesai', $item->id_transaksi) }}" method="post" style="display: none">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    </form>
                                    @elseif($item->status == 'selesai')
                                    <button class="btn btn-xs btn-primary fs---1" onclick="diambiFunctionl({{ $item->id_transaksi }})"
                                        value="{{ $item->id_transaksi }}"> Diambil
                                    </button>
                                    <form id="diambil-form-{{ $item->id_transaksi }}" action="{{ route('transaksi-laundry-diambil', $item->id_transaksi) }}" method="post" style="display: none">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    </form>
                                    @else
                                    {{ date('d-M-Y H:i:s',strtotime($item->tanggal_ambil ?? '-')) }}
                                    @endif
                                </td>
                                <td class="text-center fs--1">
                                    <a href="{{ route('cetak-laundry', $item->id_transaksi) }}" target="_blank" class="btn p-0"
                                        type="button" data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="Print"><span class="text-700 fas fa-print"></span>
                                    </a>
                                    <a href="{{ route('transaksi-laundry.show', $item->id_transaksi) }}" class="btn p-0"
                                        type="button" data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="Detail"><span class="text-700 fas fa-eye"></span>
                                    </a>
                                    @if($item->status == 'proses')
                                    <a href="{{ route('transaksi-laundry.edit', $item->id_transaksi) }}" class="btn p-0"
                                        type="button" data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="Edit"><span class="text-700 fas fa-edit"></span>
                                    </a>
                                    <button class="btn p-0" onclick="deleteFunction({{ $item->id_transaksi }})"
                                        value="{{ $item->id_transaksi }}"> <span class="text-700 fas fa-trash-alt"></span>
                                    </button>
                                    <form id="delete-form-{{ $item->id_transaksi }}" action="{{ route('transaksi-laundry.destroy', $item->id_transaksi) }}" method="post" style="display: none">
                                        @method('DELETE')
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    </form>

                                    @endif

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

<div class="modal fade" id="modalfilter" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px">
        <div class="modal-content position-relative">
            <div class="position-absolute top-0 end-0 mt-2 me-2 z-index-1">
                <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base"
                    data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('export-dokumen-harian-laundry') }}" id="form2">
                <div class="modal-body p-0">
                    <div class="rounded-top-lg py-3 ps-4 pe-6 bg-light">
                        <h4 class="mb-1">Filter Data untuk Export</h4>
                    </div>
                    <div class="p-4 pb-0">
                        <p class="text-word-break fs--1 mb-3">Filter Data Berdasarkan Inputan</p>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" id="flexRadioDefault1" type="radio" value="excel"
                                        name="radio_input" checked />
                                    <label class="form-check-label" for="flexRadioDefault1">Export Excel</label>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" id="flexRadioDefault2" type="radio" value="pdf"
                                        name="radio_input" />
                                    <label class="form-check-label" for="flexRadioDefault2">Export PDF</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3 mt-3">
                            <div class="col-12">
                                <label for="currency">Filter by Jenis Customer</label>
                                <select class="form-select js-choice" id="id_category_penerima" name="id_category_penerima"
                                    data-options='{"removeItemButton":true,"placeholder":true, "shouldSort":false}'>
                                    <option value="">Pilih Jenis Customer</option>
                                    @foreach ($jenis as $item)
                                    <option value="{{ $item->id_category_penerima }}">{{ $item->nama_kategori_penerima }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3 mt-3">
                            <div class="col-12">
                                <label for="currency">Filter by Status</label>
                                <select class="form-select js-choice" id="status" name="status"
                                    data-options='{"removeItemButton":true,"placeholder":true}'>
                                    <option value="">Pilih Status</option>
                                    <option value="proses">Sedang Proses</option>
                                    <option value="selesai">Telah Selesai</option>
                                    <option value="diambil">Sudah Diambil</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="submit">Export Data </button>
                </div>
            </form>
        </div>
    </div>
</div>

@if(!empty(Session::get('modal-tes')) && Session::get('modal-tes') == 5)
<script>
    $(function () {
        $('#btnreport').trigger("click");
    });
</script>
@endif

<script>
      function deleteFunction(itemId) {
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
                event.preventDefault()
                document.getElementById(`delete-form-${itemId}`).submit()
            }
        })
    }

      function selesaiFunction(itemId) {
        Swal.fire({
            title: 'Laundry Selesai?',
            text: "Apakah Laundry Ini Telah Selesai?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya! Telah Selesai'
        }).then((result) => {
            if (result.isConfirmed) {
                event.preventDefault()
                document.getElementById(`selesai-form-${itemId}`).submit()
            }
        })
    }

    function diambiFunctionl(itemId) {
        Swal.fire({
            title: 'Laundry Diambil?',
            text: "Apakah Laundry Telah Diambil?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya! Telah Diambil'
        }).then((result) => {
            if (result.isConfirmed) {
                event.preventDefault()
                document.getElementById(`diambil-form-${itemId}`).submit()
            }
        })
    }



    $(document).ready(function () {
        $('.deleteModalBtn').click(function (e) {
            e.preventDefault();

            var id = $(this).val();
            $('#id_transaksi').val(id)
            $('#deleteModal').modal('show');
        })

        var table = $('#example').DataTable([]);
        $('#datatableReport').DataTable();
        $('#datatableReport2').DataTable();

        var url = (window.location).href;
        var name = url.substring(url.lastIndexOf('=') + 1);

        $('.selesaiBtn').click(function (e) {
            e.preventDefault();
            var id = $(this).val();
            $('#id_transaksi_selesai').val(id)
            $('#modalSelesai').modal('show')
        })

        $('.diambilBtn').click(function (e) {
            e.preventDefault();
            var id = $(this).val();
            $('#id_transaksi_diambil').val(id)
            $('#modalDiambil').modal('show')
        })

    })
</script>



@endsection