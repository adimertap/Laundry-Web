@extends('layouts.app')

@section('content')

<main>
    <div class="card mb-3">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <h5 class="mb-2">Transaksi Kode: <span class="text-primary">#{{ $tr->nomor_transaksi }}</span>
                      <h6 class="text-uppercase text-600">Status: {{ $tr->status }} dan {{ $tr->status_paid }}</h6>
                    
                </div>
                <div class="col-auto d-none d-sm-block">
                    <h6 class="text-uppercase text-600">Pegawai {{ $tr->Pegawai->name }}<span class="fas fa-user ms-2"></span>
                    </h6>
                </div>
            </div>
        </div>
        <div class="card-body border-top">
            <div class="row mt-0">
                <div class="col-6">
                    <label class="form-label">Tanggal Transaksi</label>
                    <input class="form-control form-select-sm" value="{{ date_format($tr->created_at,"d M Y H:i:s") }}" readonly />
                </div>
                <div class="col-6">
                    <label class="form-label">Nama Customer</label>
                    <input class="form-control form-select-sm" value="{{ $tr->nama_customer }}" readonly />
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-6">
                    <label class="form-label">Nomor Telephone</label>
                    <input class="form-control form-select-sm" value="{{ $tr->nomor_telephone }}" readonly />
                </div>
                <div class="col-6">
                    <label class="form-label">Alamat Customer</label>
                    <input class="form-control form-select-sm" value="{{ $tr->alamat }}" readonly />
                </div>
            </div>
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-header bg-light">
            <p>Detail Transaksi</p>
        </div>
        <div class="card-body">
          <div class="table-responsive fs--1">
            <table class="table table-striped border-bottom">
              <thead class="bg-200 text-900">
                <tr>
                  <th class="border-0">No.</th>
                  <th class="border-0 text-center">Type</th>
                  <th class="border-0 text-center">Harga / KG</th>
                  <th class="border-0 text-center">Berat</th>
                  <th class="border-0 text-end">Total</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($tr->detail as $item)
                <tr role="row" class="odd align-middle">
                    <th scope="row" class="align-middle">{{ $loop->iteration}}.</th>
                    <td class="align-middle text-center">{{ $item->Type->nama_type }}</td>
                    <td class="align-middle text-center">Rp. {{ number_format($item->harga_kg, 0, ',', '.') }} / Kg</td>
                    <td class="align-middle text-center">{{ $item->berat }} Kg</td>
                    <td class="align-middle text-end">Rp. {{ number_format($item->total, 0, ',', '.') }}</td>
                </tr>
                @empty

                @endforelse
              </tbody>
            </table>
          </div>
          <div class="row g-0 justify-content-end">
            <div class="col-auto">
              <table class="table table-sm table-borderless fs--1 text-end">
                <tbody>
                    <tr class="border-bottom">
                        <th class="text-900">Total Berat:</th>
                        <td class="fw-semi-bold">{{ $tr->total_berat }} Kg</td>
                      </tr>
                <tr class="border-bottom">
                  <th class="text-900">Grand Total:</th>
                  <td class="fw-semi-bold">Rp. {{ number_format($tr->total, 0, ',', '.') }}</td>
                </tr>
              </tbody></table>
            </div>
            
          </div>
        </div>
        <div class="card-footer bg-light">
            <a class="btn btn-sm btn-light" href="{{ route('transaksi-laundry.index') }}">Kembali</a>
        </div>
      </div>



</main>


@endsection
