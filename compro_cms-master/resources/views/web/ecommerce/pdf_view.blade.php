<!DOCTYPE html>
<html>
<head>
    <title>Surat Pernyataan Pembelian</title>
    <style>
        body { font-family: "Times New Roman", Times, serif; font-size: 12pt; line-height: 1.5; margin: 40px; }
        .text-center { text-align: center; }
        .text-bold { font-weight: bold; }
        .uppercase { text-transform: uppercase; }
        .mb-4 { margin-bottom: 20px; }
        .table-data { width: 100%; margin-bottom: 20px; }
        .table-data td { padding: 5px; vertical-align: top; }
        .checkbox-box { display: inline-block; width: 15px; height: 15px; border: 1px solid #000; margin-right: 5px; text-align: center; line-height: 13px; font-size: 12px; }
        .checked::after { content: "X"; font-weight: bold; }
        .indent { padding-left: 20px; }
        .signature-section { margin-top: 50px; display: flex; justify-content: flex-end; }
        .sign-box { width: 250px; text-align: center; }
        
        @media print {
            body { margin: 20px; }
            .no-print { display: none; }
        }
    </style>
</head>
<body onload="window.print()">

    <div class="no-print" style="position: fixed; top: 0; left: 0; width: 100%; background: #fff; padding: 10px; border-bottom: 1px solid #ccc; text-align: center;">
        <button onclick="window.print()" style="padding: 10px 20px; cursor: pointer;">Cetak / Simpan sebagai PDF</button>
        <button onclick="window.close()" style="padding: 10px 20px; cursor: pointer;">Tutup</button>
    </div>

    <div class="text-center text-bold uppercase mb-4" style="margin-top: 50px;">
        SURAT PERNYATAAN PEMBELIAN<br>
        PENGGUNA LAPTOP SEWA HP TAHUN {{ date('Y') }}
    </div>

    <p>Yang bertanda tangan dibawah ini :</p>
    
    <table class="table-data">
        <tr>
            <td width="30">1.</td>
            <td width="150">Nama</td>
            <td width="10">:</td>
            <td>{{ $order->customer_name }}</td>
        </tr>
        <tr>
            <td>2.</td>
            <td>N P P</td>
            <td>:</td>
            <td>{{ $order->customer_id_num }}</td>
        </tr>
        <tr>
            <td>3.</td>
            <td>Wilayah Kerja</td>
            <td>:</td>
            <td>
                <span class="checkbox-box {{ $order->wilayah_kerja == 'pusat' ? 'checked' : '' }}"></span> KANTOR PUSAT
                &nbsp;&nbsp;&nbsp;&nbsp;
                <span class="checkbox-box {{ $order->wilayah_kerja == 'wilayah' ? 'checked' : '' }}"></span> KANTOR WILAYAH
                <br>
                <i>( beri tanda centang / tanda "X" pada pilihan )</i>
            </td>
        </tr>
        <tr>
            <td>4.</td>
            <td>Unit Kerja</td>
            <td>:</td>
            <td>
                @php
                    $unit_detail = json_decode($order->unit_kerja_detail, true);
                    // Fallback for legacy data/legacy switch logic if JSON fails
                    if(!is_array($unit_detail)) {
                         $unit_detail = [
                             'kab_kota' => ($order->unit_kerja_type == 'kab_kota') ? $order->unit_kerja_detail : '',
                             'cabang' => ($order->unit_kerja_type == 'cabang') ? $order->unit_kerja_detail : '',
                             'deputi' => ($order->unit_kerja_type == 'deputi') ? $order->unit_kerja_detail : '',
                         ];
                    }
                @endphp
                <div style="margin-bottom: 5px;">
                    a. Kab / Kota / : <span style="border-bottom: 1px dotted #000; display: inline-block; min-width: 200px;">{{ $unit_detail['kab_kota'] ?? '' }}</span>
                </div>
                <div style="margin-bottom: 5px;">
                    b. Kantor Cabang/As.Dep : <span style="border-bottom: 1px dotted #000; display: inline-block; min-width: 200px;">{{ $unit_detail['cabang'] ?? '' }}</span>
                </div>
                <div>
                    c. Dep.Dir.Bid/Dep.Dir.Wil : <span style="border-bottom: 1px dotted #000; display: inline-block; min-width: 200px;">{{ $unit_detail['deputi'] ?? '' }}</span>
                </div>
            </td>
        </tr>
        <tr>
            <td>5.</td>
            <td>Nomor HP</td>
            <td>:</td>
            <td>{{ $order->customer_contact }}</td>
        </tr>
        <tr>
            <td>6.</td>
            <td>Status Pengguna</td>
            <td>:</td>
            <td>
                <span class="checkbox-box {{ $order->user_status == 'pengguna' ? 'checked' : '' }}"></span> Pengguna Laptop Sewa
                &nbsp;&nbsp;
                <span class="checkbox-box {{ $order->user_status == 'bukan_pengguna' ? 'checked' : '' }}"></span> Bukan Pengguna Laptop Sewa
                <br>
                <i>( beri tanda centang / tanda "X" pada pilihan )</i>
            </td>
        </tr>
        <tr>
            <td>7.</td>
            <td>Nomor Serial Number Laptop</td>
            <td>:</td>
            <td>{{ $order->laptop_serial_number ?? '__________________________' }}</td>
        </tr>
        <tr>
            <td colspan="4" style="font-size: 10px;">(Diisi khusus Pengguna Laptop Sewa)</td>
        </tr>
    </table>

    <div style="display: flex;">
        <div style="width: 30px;">A.</div>
        <div>
            Sehubungan dengan surat dari PT Cepat Mudah Setara Duta Solusi tentang penawaran laptop bekas Pengadaan Sewa Perangkat Pengguna Akhir Nasional {{ date('Y') }} kepada pegawai BPJS Kesehatan, maka dengan ini <b>saya menyatakan</b> :
            
            <ol style="margin-top: 10px; padding-left: 20px;">
                <li style="margin-bottom: 10px;">
                    Berminat untuk membeli Laptop HP Sewa BPJS Kesehatan dengan harga sesuai pada marketplace, dengan total harga sebesar Rp. <b>{{ number_format($order->total_amount, 0, ',', '.') }}</b>
                </li>
                <li style="margin-bottom: 10px;">
                    Bersedia melakukan pembelian Laptop HP Sewa dengan Mekanisme Pembayaran :
                    <br>
                    <i>( beri tanda centang / tanda "X" pada pilihan )</i>
                    
                    <div style="margin-top: 10px;">
                        <table style="width: 100%;">
                            <tr>
                                <td width="30" style="vertical-align: top;">a.</td>
                                <td>
                                    <span class="checkbox-box {{ $order->payment_mechanism == 'transfer' ? 'checked' : '' }}"></span> Pembayaran langsung melalui transfer <b>VA Bank BNI yang akan diinformasikan melalui Whatsapp Calon Pembeli oleh PT CMS Duta Solusi</b>
                                </td>
                            </tr>
                            <tr>
                                <td width="30" style="vertical-align: top;">b.</td>
                                <td>
                                    Pembayaran melalui pemotongan gaji dengan cara :
                                    <div style="margin-top: 5px;">
                                        1) <span class="checkbox-box {{ ($order->payment_mechanism == 'potong_gaji' && $order->payroll_deduction_periods == 1) ? 'checked' : '' }}"></span> Pembayaran dengan cara 1 (satu) kali pemotongan Gaji
                                    </div>
                                    <div style="margin-top: 5px;">
                                        2) <span class="checkbox-box {{ ($order->payment_mechanism == 'potong_gaji' && $order->payroll_deduction_periods == 2) ? 'checked' : '' }}"></span> Pembayaran dengan cara 2 (dua) kali pemotongan Gaji
                                    </div>
                                    <div style="margin-top: 5px;">
                                        3) <span class="checkbox-box {{ ($order->payment_mechanism == 'potong_gaji' && $order->payroll_deduction_periods == 3) ? 'checked' : '' }}"></span> Pembayaran dengan cara 3 (tiga) kali pemotongan Gaji
                                    </div>
                                    <div style="margin-top: 5px;">
                                        4) <span class="checkbox-box {{ ($order->payment_mechanism == 'potong_gaji' && $order->payroll_deduction_periods == 4) ? 'checked' : '' }}"></span> Pembayaran dengan cara 4 (empat) kali pemotongan Gaji
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </li>
                <li style="margin-bottom: 10px;">
                    Telah mengetahui dan memahami kondisi Laptop HP Sewa yaitu :
                    <ol type="a">
                        <li>Kondisi Laptop HP Sewa yang dibeli adalah <b>sesuai dengan kondisi apa adanya seperti saat ini</b> ( <i>as-is</i> )</li>
                        <li>Kondisi Laptop HP Sewa yang dibeli :
                            <br>1) <b>Tidak termasuk Disk SSD Storage</b>
                            <br>2) <b>Tidak memiliki Garansi</b>
                        </li>
                    </ol>
                </li>
            </ol>
        </div>
    </div>

    <div style="display: flex; margin-bottom: 10px;">
        <div style="width: 30px;">B.</div>
        <div>
            Dengan pernyataan ini saya tidak akan membatalkan pembelian Laptop HP Sewa
        </div>
    </div>

    <div style="display: flex; margin-bottom: 30px;">
        <div style="width: 30px;">C.</div>
        <div>
            Prioritas utama pembelian Laptop HP Sewa adalah bagi pengguna/pemakai langsung Laptop HP Sewa BPJS Kesehatan
        </div>
    </div>

    <div class="signature-section">
        <div class="sign-box">
            <p>................., ........................... {{ date('Y') }}</p>
            <br><br><br><br>
            <p style="text-decoration: underline; font-weight: bold;">( {{ strtoupper($order->customer_name) }} )</p>
            <p>NPP. {{ $order->customer_id_num }}</p>
        </div>
    </div>

</body>
</html>
