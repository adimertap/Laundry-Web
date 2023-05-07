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
                                <th class="sort text-center fs--1" data-sort="nomor_transaksi">Kode</th>
                                <th class="sort text-center fs--1" data-sort="nama_customer" style="width: 100px">
                                    Customer</th>
                                <th class="sort text-center fs--1" data-sort="nomor_telephone">Phone</th>
                                <th class="sort text-center fs--1" data-sort="total_berat">Berat</th>
                                <th class="sort text-center fs--1" data-sort="total">Total</th>
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
                                <td class="text-center nomor_transaksi fs--1">{{ $item->nomor_transaksi }}</td>
                                <td class="text-center nama_customer fs--1">{{ $item->nama_customer }}</td>
                                <td class="text-center nomor_telephone fs--1">{{ $item->nomor_telephone }}</td>
                                <td class="text-center alamat fs--1">{{ $item->total_berat }} kg</td>
                                <td class="text-center total text-center fs--1">Rp.
                                    {{ number_format($item->total, 0,',', '.') }}</td>
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
                                    <button class="btn btn-xs btn-light fs---1 selesaiBtn"
                                        value="{{ $item->id_transaksi }}" type="button"> Selesai
                                    </button>
                                    @elseif($item->status == 'selesai')
                                    <button class="btn btn-xs btn-primary fs---1 diambilBtn"
                                        value="{{ $item->id_transaksi }}" type="button"> Diambil
                                    </button>
                                    @else
                                    {{ $formatted_date = date_format($date, 'd M Y H:i:s') }}
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
                                    <button class="btn p-0 deleteModalBtn" value="{{ $item->id_transaksi }}"
                                        type="button" data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="Delete"><span class="text-700 fas fa-trash-alt"></span>
                                    </button>

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

<div class="modal fade" id="deleteModal" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0">
            <div class="position-absolute top-0 end-0 mt-3 me-3 z-index-1"><button
                    class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base" data-bs-dismiss="modal"
                    aria-label="Close"></button></div>
            <form action="{{ route('transaksi-laundry.destroy', "1") }}" method="POST">
                @method("DELETE")
                @csrf
                <div class="modal-body p-0">
                    <div class="bg-danger rounded-top-lg py-3 ps-4 pe-6">
                        <h4 class="mb-1 text-white">Hapus Data Transaksi</h4>
                    </div>
                    <div class="p-3">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="d-flex">
                                    <div class="flex-1">
                                        <input type="hidden" name="transaksi_id" id="id_transaksi">
                                        <h5 class="mb-2 fs-0">Confirmation</h5>
                                        <p class="text-word-break fs--1">Apakah Anda Yakin Menghapus Data Transaksi ini?
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

<div class="modal fade" id="modalSelesai" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0">
            <div class="position-absolute top-0 end-0 mt-3 me-3 z-index-1"><button
                    class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base" data-bs-dismiss="modal"
                    aria-label="Close"></button></div>
            <form action="{{ route('transaksi-laundry-selesai') }}" method="POST">
                @csrf
                <div class="modal-body p-0">
                    <div class="bg-light rounded-top-lg py-3 ps-4 pe-6">
                        <h4 class="mb-1">Ubah Status Transaksi</h4>
                    </div>
                    <div class="p-3">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="d-flex">
                                    <div class="flex-1">
                                        <input type="hidden" name="transaksi_id" id="id_transaksi_selesai">
                                        <h5 class="mb-2 fs-0">Confirmation</h5>
                                        <p class="text-word-break fs--1">Apakah Transaksi ini Telah Selesai?</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary btn-sm" type="button" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-success btn-sm" type="submit">Ya! Selesai </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalDiambil" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0">
            <div class="position-absolute top-0 end-0 mt-3 me-3 z-index-1"><button
                    class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base" data-bs-dismiss="modal"
                    aria-label="Close"></button></div>
            <form action="{{ route('transaksi-laundry-diambil') }}" method="POST">
                @csrf
                <div class="modal-body p-0">
                    <div class="bg-light rounded-top-lg py-3 ps-4 pe-6">
                        <h5 class="mb-1">Ubah Status Laundry Telah Diambil</h5>
                    </div>
                    <div class="p-3">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="d-flex">
                                    <div class="flex-1">
                                        <input type="hidden" name="transaksi_id" id="id_transaksi_diambil">
                                        <h6 class="mb-2 fs-0">Confirmation</h6>
                                        <p class="text-word-break fs--1">Apakah Laundry Telah diambil oleh Customer?</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary btn-sm" type="button" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-success btn-sm" type="submit">Ya! Sudah </button>
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