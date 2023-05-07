@extends('layouts.app')

@section('content')
<main>
    <div class="card mb-3">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <div class="col-auto align-self-center">
                    <h5 class="mb-0" data-anchor="data-anchor">Rekapan Data Customer
                    </h5>
                    <p class="mb-0 pt-1 m-0 mt-0">Manajemen Data Customer</p>
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
                                <th class="sort text-center fs--1" data-sort="nama_customer" style="width: 100px">Customer</th>
                                <th class="sort text-center fs--1" data-sort="nomor_telephone">Phone</th>
                                <th class="sort text-center fs--1" data-sort="total_berat">Alamat</th>
                            </tr>
                        </thead>
                        <tbody class="list small">
                            @forelse ($cust as $item)
                            <tr role="row" class="odd">
                                <th scope="row" class="text-center no fs--1">{{ $loop->iteration}}.</th>
                                <td class="text-center fs--1">{{ $item->nama }}</td>
                                <td class="text-center fs--1">{{ $item->phone }}</td>
                                <td class="text-center fs--1">{{ $item->alamat }}</td>
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

<script>
    $(document).ready(function () {
        $('#example').DataTable()
    })
</script>
@endsection
