<!DOCTYPE html>
<html>
<head>
    <title>Surat Pernyataan Pembelian</title>
    <style>
        body { font-family: "Times New Roman", Times, serif; font-size: 12pt; line-height: 1.5; margin: 40px; }
        .no-print { display: none; }
        @media print {
            body { margin: 20px; }
            .no-print { display: none; }
        }
    </style>
</head>
<body onload="javascript:window.print()">
    <div class="no-print" style="position: fixed; top: 0; left: 0; width: 100%; background: #fff; padding: 10px; border-bottom: 1px solid #ccc; text-align: center; z-index: 999;">
        <button onclick="window.print()" style="padding: 10px 20px; cursor: pointer;">Cetak / Simpan sebagai PDF</button>
        <button onclick="window.close()" style="padding: 10px 20px; cursor: pointer;">Tutup</button>
    </div>

    {!! $html !!}
</body>
</html>
