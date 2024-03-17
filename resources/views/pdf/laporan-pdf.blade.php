<!DOCTYPE html>
<html>

<head>
    <style>
        table {
            width: 100%;
            text-align: center;
        }
    </style>
</head>

<body>
    <h1 style="text-align: center">Laporan Orderan Laundry</h1>

    {{-- <h4>Laopran Orderan Dari :</h4> --}}
    <table border="2">
        <thead>
            <th>No</th>
            <th>Tanggal</th>
            <th>Kode</th>
            <th>Jumlah</th>
            <th>Jenis Layanan</th>
            <th>Total Harga</th>
            <th>Status</th>
            <th>Status Pembayaran</th>
            <th>Nama</th>
            <th>Kontak</th>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $order->updated_at->format('d-m-y') }}</td>
                    <td>{{ $order->kode_laundry }}</td>
                    <td>{{ $order->jumlah }}</td>
                    <td>{{ $order->layanan->nama_layanan }}</td>
                    <td>{{ 'Rp' . number_format($order->total_harga, 0, ',', '.') }}</td>
                    <td class="@if ($order->status == 'baru') bg-danger @elseif($order->status == 'proses') bg-warning @else bg-success @endif text-white border"
                        style="text-transform: uppercase;">
                        {{ $order->status }}
                    </td>
                    <td class="@if ($order->pembayaran->status_pembayaran == 'lunas') bg-success @else bg-danger @endif text-white"
                        style="text-transform: uppercase;">
                        {{ $order->pembayaran->status_pembayaran }}
                    </td>
                    <td>{{ $order->konsumen->nama }}</td>
                    <td>{{ $order->konsumen->no_telp }}</td>
                </tr>
            @endforeach
            @php
                $totalPendapatan = $orders->sum('total_harga');
            @endphp
            <tr>
                <td colspan="9" style="text-align: right;"><h4 style="padding-right: 5%;">Total Pendapatan:</h4></td>
                <td>{{ 'Rp' . number_format($totalPendapatan, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>
</body>

</html>
