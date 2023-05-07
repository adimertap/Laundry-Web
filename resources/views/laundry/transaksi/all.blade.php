@extends('layouts.app')

@section('content')
<main>
    <div class="card py-3 mb-3">
        <div class="card-body py-3">
            <div class="row g-0">
                <div class="col-6 col-md-6 border-200 border-bottom border-end pb-4">
                    <h6 class="pb-1 text-700">Transaksi Keseluruhan</h6>
                    <p class="font-sans-serif lh-1 mb-1 fs-2">{{ $jumlah }}</p>
                    <div class="d-flex align-items-center">
                        <h6 class="fs--1 text-500 mb-0">Transaksi</h6>
                    </div>
                </div>
                <div class="col-6 col-md-6 border-200 border-md-200 border-bottom border-md-end pb-4 ps-3">
                    <h6 class="pb-1 text-700">Total Transaksi Keseluruhan</h6>
                    <p class="font-sans-serif lh-1 mb-1 fs-2">Rp. {{ number_format($total, 0, ',', '.') }}</p>
                    <div class="d-flex align-items-center">
                        <h6 class="fs--1 text-500 mb-0"></h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card mb-3">
        <div class="bg-holder d-none d-lg-block bg-card"
            style="background-image:url(/../falcon/assets/img/icons/spot-illustrations/corner-4.png);"></div>
        <div class="card-body position-relative">
            <div class="row">
                <div class="col-lg-6">
                    <h5>Filter Data Sesuai Tanggal Inputan</h5>
                    <p class="mt-2">Pilih Tanggal Awal dan Pilih Tanggal Akhir</p>
                    <hr>
                    <button class="btn btn-falcon-default btn-sm me-1 mb-2 mb-sm-0" type="button" data-bs-toggle="modal"
                        data-bs-target="#modalfilter"><span class="fas fa-arrow-down me-1"> </span>Download Laporan
                        (.excel)/(.pdf)
                    </button>
                </div>
                <div class="col-lg-6">
                    <div class="col-12 col-xl-auto mt-2">
                        <span id="total_records"></span>
                        <p></p>
                        <form id="form1">
                            <div class="row input-daterange">
                                <div class="col-md-4">
                                    <label class="small">Start Date</label>
                                    <input class="form-control datetimepicker" id="from_date" type="date"
                                        name="from_date" placeholder="From Date"
                                        data-options='{"disableMobile":true}' />
                                </div>
                                <div class="col-md-4">
                                    <label class="small">End Date</label>
                                    <input class="form-control datetimepicker" id="to_date" type="date" name="to_date"
                                        placeholder="To Date" data-options='{"disableMobile":true}' />
                                </div>
                                <div class="col-md-4">
                                    <button type="button" name="filter" onclick="filter_tanggal(event)"
                                        class="btn btn-primary px-4 mt-4">Filter</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <div class="col-auto align-self-center">
                    <h5 class="mb-0">Rekapan Data Transaksi Keseluruhan
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
                                <th class="sort text-center fs--1" data-sort="nama_customer" style="width: 100px">Customer</th>
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
                                <td class="text-center tanggal_transaksi fs--1">{{ date('d-M-Y H:i:s',
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
                                    {{ date('d-M-Y H:i:s',strtotime($item->tanggal_ambil ?? '-')) }}
                                    @endif
                                </td>
                                <td class="text-center fs--1">
                                    <a href="{{ route('cetak-laundry', $item->id_transaksi) }}" target="_blank"
                                        class="btn p-0" type="button" data-bs-toggle="tooltip" data-bs-placement="top"
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

<div class="modal fade" id="modalfilter" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px">
        <div class="modal-content position-relative">
            <div class="position-absolute top-0 end-0 mt-2 me-2 z-index-1">
                <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base"
                    data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('export-dokumen-laundry') }}" id="form2">
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
                        <div class="row input-daterange">
                            <div class="col-md-6">
                                <label class="small">Start Date</label>
                                <input class="form-control datetimepicker" id="from_date_export" type="date"
                                    name="from_date_export" placeholder="From Date"
                                    data-options='{"disableMobile":true}' />
                            </div>
                            <div class="col-md-6">
                                <label class="small">End Date</label>
                                <input class="form-control datetimepicker" id="to_date_export" type="date"
                                    name="to_date_export" placeholder="To Date" data-options='{"disableMobile":true}' />
                            </div>
                        </div>
                        <div class="row mb-3 mt-3">
                            <div class="col-12">
                                <label for="currency">Filter by Jenis</label>
                                <select class="form-select js-choice" id="id_jenis" name="id_jenis"
                                    data-options='{"removeItemButton":true,"placeholder":true, "shouldSort":false}'>
                                    <option value="">Pilih Jenis</option>
                                    @foreach ($jenis as $item)
                                    <option value="{{ $item->id_category_penerima }}">{{ $item->nama_kategori_penerima }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3 mt-3">
                            <div class="col-12">
                                <label for="currency">Filter by Pegawai</label>
                                <select class="form-select js-choice" id="pegawai" name="id_pegawai"
                                    data-options='{"removeItemButton":true,"placeholder":true}'>
                                    <option value="">Pilih Pegawai</option>
                                    @foreach ($pegawai as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
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
                    <button class="btn btn-primary" type="submit">Filter dan Export Data </button>
                </div>
            </form>
        </div>
    </div>
</div>

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


<script>
    $(document).ready(function () {
        var table = $('#example').DataTable();

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

        $('.deleteModalBtn').click(function (e) {
            e.preventDefault();

            var id = $(this).val();
            $('#id_transaksi').val(id)
            $('#deleteModal').modal('show');
        })

    })

    function filter_tanggal(event) {
        event.preventDefault()
        var form1 = $('#form1')
        var tanggal_mulai = form1.find('input[name="from_date"]').val()
        var tanggal_selesai = form1.find('input[name="to_date"]').val()
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
            icon: 'info',
            title: 'Mohon Tunggu, Sedang diproses ...'
        })
        window.location.href = '/transaksi-laundry-all?from=' + tanggal_mulai + '&to=' + tanggal_selesai
    }
</script>



@endsection