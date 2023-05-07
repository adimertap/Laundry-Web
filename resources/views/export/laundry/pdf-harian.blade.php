<!DOCTYPE html>
<html>
<head>
	<title>Laporan Transaksi</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
	</style>
	<center>
		<h5>Laporan Transaksi Laundry</h4>
        <p>{{ $today }}</h4>
	</center>
 
	<table class='table table-bordered'>
		<thead>
          
			<tr>
				<th>No</th>
                <th>Tanggal</th>
				<th>Jenis</th>
				<th>Cust</th>
				<th>Alamat</th>
                <th>Type</th>
                <th>Harga</th>
				<th>Berat (Kg)</th>
                <th>Total (Rp)</th>
			</tr>
		</thead>
		<tbody>
			@php 
				$i=1; 
				$total_banget = 0; 
				foreach ($transaksi as $key => $item) {
					$total_banget = $total_banget + $item->total;
				}
				
			@endphp
			@foreach($transaksi as $p)
			<tr>
				<td>{{ $i++ }}</td>
				<td>{{ date('d-M-Y', strtotime($p->tanggal_transaksi)) }}</td>
				<td>{{$p->nama_kategori_penerima}}</td>
				<td>{{$p->nama_customer}}</td>
				<td>{{$p->alamat}}</td>
				<td>{{$p->nama_type}}</td>
				<td>{{ number_format($p->price)}}</td>
				<td>{{$p->berat}}</td>
				<td>{{ number_format($p->total)}}</td>
			</tr>
			@endforeach
		</tbody>
        <tr>
            <th colspan="7">Transaksi</th>
            <th colspan="1">{{ $jumlah }} Transaksi</th>
            <th colspan="1">{{ number_format($total_banget) }}</th>
        </tr>
	</table>
 
</body>
</html>