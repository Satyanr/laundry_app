<!DOCTYPE html>
<html>

<head>
    <title>Barcode</title>
</head>

<body style="text-align: center;">
    <h2>Laundry SMKN 1 Ciamis</h2>

    <div style="margin-left: 470px"> {!! $barcode !!} </div>

    <h4>Kode Laundry: {{ $code }}</h4>
    <h4>Total Bayar: {{ 'Rp ' . number_format($ttlbyr, 0, ',', '.') }}</h4>
</body>

</html>
