<!DOCTYPE html>
<html>
<head>
    <title>Recap Orders - {{ date('d M Y') }}</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 10pt; color: #333; margin: 0; padding: 20px; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #444; padding-bottom: 10px; }
        .header h2 { margin: 0; text-transform: uppercase; color: #004aad; }
        .header p { margin: 5px 0 0; color: #666; }
        
        .filter-info { margin-bottom: 20px; font-size: 9pt; background: #f9f9f9; padding: 10px; border-radius: 5px; border: 1px solid #eee; }
        .filter-info span { font-weight: bold; color: #004aad; margin-right: 15px; }

        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th { background-color: #f2f2f2; color: #444; font-weight: bold; text-align: left; padding: 10px; border: 1px solid #ddd; font-size: 9pt; }
        td { padding: 8px 10px; border: 1px solid #ddd; vertical-align: top; font-size: 8.5pt; }
        tr:nth-child(even) { background-color: #fafafa; }

        .badge { padding: 2px 6px; border-radius: 3px; font-size: 8pt; font-weight: bold; text-transform: uppercase; }
        .badge-pending { background: #fff3cd; color: #856404; }
        .badge-paid { background: #d4edda; color: #155724; }
        .badge-processing { background: #cce5ff; color: #004085; }
        .badge-completed { background: #d1ecf1; color: #0c5460; }
        .badge-failed { background: #f8d7da; color: #721c24; }

        .text-right { text-align: right; }
        .footer { position: fixed; bottom: 20px; width: 100%; text-align: center; font-size: 8pt; color: #999; border-top: 1px solid #eee; padding-top: 10px; }
        
        @media print {
            .no-print { display: none; }
            body { padding: 0; }
        }
    </style>
</head>
<body onload="window.print()">

    <div class="no-print" style="position: fixed; top: 0; left: 0; width: 100%; background: #004aad; padding: 10px; color: white; text-align: center; z-index: 1000; box-shadow: 0 2px 10px rgba(0,0,0,0.2);">
        <button onclick="window.print()" style="background: white; border: none; padding: 8px 20px; border-radius: 4px; font-weight: bold; cursor: pointer; color: #004aad; margin-right: 10px;">
            <i class="fas fa-print"></i> CETAK / SIMPAN PDF
        </button>
        <button onclick="window.close()" style="background: rgba(255,255,255,0.2); border: 1px solid white; padding: 8px 20px; border-radius: 4px; font-weight: bold; cursor: pointer; color: white;">
            TUTUP
        </button>
    </div>

    <div class="header" style="margin-top: 60px;">
        <h2>Rekapitulasi Pesanan E-Commerce</h2>
        <p>Laporan per tanggal: {{ date('d F Y, H:i') }} WIB</p>
    </div>

    <div class="filter-info">
        <span>Status: {{ ucfirst($filter['status'] ?? 'Semua') }}</span>
        <span>Wilayah: {{ ucfirst($filter['wilayah'] ?? 'Semua') }}</span>
        <span>Pembayaran: {{ $filter['payment'] == 'transfer' ? 'VA Transfer' : ($filter['payment'] == 'potong_gaji' ? 'Potong Gaji' : 'Semua') }}</span>
        <span style="float: right;">Total Data: {{ count($rows) }}</span>
    </div>

    <table>
        <thead>
            <tr>
                <th width="30">No</th>
                <th>Order #</th>
                <th>Tgl Pesan</th>
                <th>Nama Pelanggan / NPP</th>
                <th>Wilayah / Unit</th>
                <th>Mekanisme</th>
                <th>Total Bayar</th>
                <th width="80">Status</th>
            </tr>
        </thead>
        <tbody>
            @php $totalSemua = 0; @endphp
            @foreach($rows as $key => $row)
            @php $totalSemua += $row->total_amount; @endphp
            <tr>
                <td style="text-align: center;">{{ $key + 1 }}</td>
                <td style="font-weight: bold;">#{{ $row->order_number }}</td>
                <td>{{ $row->created_at->format('d/m/Y') }}<br><small>{{ $row->created_at->format('H:i') }}</small></td>
                <td>
                    {{ $row->customer_name }}<br>
                    <small class="text-muted">NPP: {{ $row->customer_id_num }}</small>
                </td>
                <td>
                    <span style="text-transform: uppercase; font-size: 7.5pt; color: #004aad;">{{ $row->wilayah_kerja }}</span><br>
                    <small>{{ $row->kdkc ?: '-' }} / {{ $row->kdkr ?: '-' }}</small>
                </td>
                <td>{{ $row->payment_mechanism == 'transfer' ? 'VA Transfer' : 'Potong Gaji' }}</td>
                <td class="text-right">Rp {{ number_format($row->total_amount, 0, ',', '.') }}</td>
                <td style="text-align: center;">
                    <span class="badge badge-{{ $row->status }}">{{ $row->status }}</span>
                </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr style="background: #eee; font-weight: bold;">
                <td colspan="6" class="text-right">TOTAL PENDAPATAN</td>
                <td class="text-right">Rp {{ number_format($totalSemua, 0, ',', '.') }}</td>
                <td></td>
            </tr>
        </tfoot>
    </table>

    <div class="footer">
        Dicetak secara otomatis oleh Sistem CMS PT Cepat Mudah Setara pada {{ date('d/m/Y H:i:s') }}
    </div>

</body>
</html>
