<!DOCTYPE html>
<html>

<head>
    <title>Barcode</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body style="text-align: center;">
    <h2>Laundry SMKN 1 Ciamis</h2>
    <div style="padding: 100px">
        <img src="data:image/png;base64, {!! base64_encode(QrCode::size(100)->generate('http://localhost:8000/info-laundryan/' . $code . '')) !!} ">
    </div>
    <h4>Kode Laundry: {{ $code }}</h4>
    <h4>Total Bayar: {{ 'Rp ' . number_format($order->total_harga, 0, ',', '.') }}</h4>
    <h4>Jumlah : {{ $order->jumlah }}</h4>
    <h4>Layanan : {{ $order->layanan->nama_layanan }}</h4>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
