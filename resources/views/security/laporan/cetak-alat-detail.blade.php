<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kwitansi Pengembalian Alat</title>
    <style>
        @page {
            size: A4 landscape;
            margin: 0;
        }

        body {
            margin: 1cm;
            font-family: Arial, sans-serif;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo {
            height: 80px;
            width: auto;
            display: block;
            margin: 0 auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 14px; /* Menambahkan font-size 10px */
        }

        th,
        td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .wrap-text {
            word-wrap: break-word;
            white-space: normal;
        }

        .info {
            margin-bottom: 20px;
        }

        .info p {
            margin: 5px 0;
        }

        .print-button {
            display: block;
            width: 100%;
            text-align: right;
            margin-bottom: 20px;
        }

        .print-button button {
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
        }

        .ttd-section {
            margin-top: 40px;
            display: flex;
            justify-content: space-between;
        }

        .ttd-section div {
            text-align: center;
            width: 45%;
        }

        .ttd-line {
            display: inline-block;
            width: 200px;
            margin-top: 60px;
            border-top: 1px solid #000;
        }

        @media print {
            .print-button {
                display: none;
            }
        }
    </style>
</head>

<body>
    <header>
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/9e/Logo_of_People%27s_Consultative_Assembly_Indonesia.png/625px-Logo_of_People%27s_Consultative_Assembly_Indonesia.png"
            alt="Logo Perusahaan" class="logo">
        <h1>Laporan Riwayat Alat</h1>
    </header>

    <div class="print-button">
        <button onclick="window.print()">Print Kwitansi</button>
    </div>

    <main>
        <div class="info">
            <table style="border: none;">
                <tr>
                    <td width="20%">Nama Alat</td>
                    <td>{{ $alat->jenis->nama_jenis }} - {{ $alat->merk }} - {{ $alat->type }}</td>
                </tr>
            </table>
        </div>

        <table>
            <thead>
                <tr>
                    <th style="width: 3%;">No</th>
                    <th style="width: 8%;">No Invoice</th>
                    <th style="width: 15%;">Nama Pelanggan</th>
                    <th style="width: 10%;">Tanggal Sewa</th>
                    <th style="width: 10%;">Tanggal Kembali</th>
                    <th style="width: 12%;">Tanggal Pengembalian</th>
                    <th style="width: 8%;">Lama Sewa</th>
                    <th style="width: 10%;">Biaya Sewa</th>
                    <th style="width: 8%;">Denda</th>
                    <th style="width: 10%;">Total Pembayaran</th>
                    <th style="width: 10%;">Status Pembayaran</th>
                    <th style="width: 10%;">Status Rental</th>
                    <th style="width: 10%;">Status Pengembalian</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($riwayat as $data)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td class="wrap-text">{{ $data->no_invoice }}</td>
                    <td class="wrap-text">{{ $data->pelanggan->nama_pelanggan }}</td>
                    <td class="wrap-text">{{ $data->tanggal_sewa }}</td>
                    <td class="wrap-text">{{ $data->tanggal_kembali }}</td>
                    <td class="wrap-text">{{ $data->tanggal_pengembalian }}</td>
                    <td class="wrap-text">{{ $data->lama_sewa }}</td>
                    <td class="wrap-text">{{ number_format($data->biaya_sewa, 0, ',', '.') }}</td>
                    <td class="wrap-text">{{ number_format($data->denda_perhari, 0, ',', '.') }}</td>
                    <td class="wrap-text">{{ number_format($data->total_pembayaran, 0, ',', '.') }}</td>
                    <td class="wrap-text">{{ $data->status_pembayaran }}</td>
                    <td class="wrap-text">{{ $data->status_rental }}</td>
                    <td class="wrap-text">{{ $data->status_pengembalian }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{-- <div class="ttd-section">
            <div>
                <p>Penyewa,</p>
                <div class="ttd-line"></div>
                <p>({{ $data->pelanggan->nama_pelanggan }})</p>
            </div>
            <div>
                <p>Petugas,</p>
                <div class="ttd-line"></div>
                <p>(Nama Petugas)</p>
            </div>
        </div> --}}
    </main>

    <script>
        function formatRupiah(angka, prefix) {
            var number_string = angka.toString().replace(/[^,\d]/g, ''),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp ' + rupiah : '');
        }

        document.addEventListener("DOMContentLoaded", function() {
            var biayaPengembalian = document.getElementById('biaya-sewa');
            var totalPembayaran = document.getElementById('total-pembayaran');
            var dendaPerhari = document.getElementById('denda');

            if (biayaPengembalian) {
                biayaPengembalian.textContent = formatRupiah(biayaPengembalian.textContent, 'Rp');
            }
            if (dendaPerhari) {
                dendaPerhari.textContent = formatRupiah(dendaPerhari.textContent, 'Rp');
            }
            if (totalPembayaran) {
                totalPembayaran.textContent = formatRupiah(totalPembayaran.textContent, 'Rp');
            }
        });
    </script>
</body>

</html>
