<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kwitansi Pengembalian Alat</title>
    <style>
        @page {
            size: A4;
            margin: 0;
        }

        body {
            margin: 2cm;
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
        }

        th,
        td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
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
        <h1>Kwitansi Pengembalian Alat</h1>
    </header>

    <div class="print-button">
        <button onclick="window.print()">Print Kwitansi</button>
    </div>

    <main>
        <div class="info">
            <table style="border: none;">
                <tr>
                    <td width="20%">No Invoice</td>
                    <td>{{$rental->no_invoice}}</td>
                </tr>
                <tr>
                    <td width="20%">Nama Pelanggan</td>
                    <td>{{$rental->Pelanggan->nama_pelanggan}}</td>
                </tr>
                <tr>
                    <td width="20%">Alat</td>
                    <td>{{$rental->alat->jenis->nama_jenis}} || {{ $rental->alat->merk }} || {{$rental->alat->type}}</td>
                </tr>
                <tr>
                    <td width="20%">Tanggal Sewa</td>
                    <td>{{$rental->tanggal_sewa}}</td>
                </tr>
                <tr>
                    <td width="20%">Tanggal Kembali</td>
                    <td>{{$rental->tanggal_kembali}}</td>
                </tr>
                <tr>
                    <td width="20%">Tanggal Pengembalian</td>
                    <td>{{$rental->tanggal_pengembalian}}</td>
                </tr>
                <tr>
                    <td width="20%">Lama Sewa</td>
                    <td>{{$rental->lama_sewa}}</td>
                </tr>
                <tr>
                    <td width="20%">Status Pembayaran</td>
                    <td>{{$rental->status_pembayaran}}</td>
                </tr>
                <tr>
                    <td width="20%">Status Pengembalian</td>
                    <td>{{$rental->status_pengembalian}}</td>
                </tr>
            </table>
        </div>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Deskripsi</th>
                    <th>Biaya</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Biaya Pengembalian</td>
                    <td id="biaya-sewa">{{$rental->biaya_sewa}}</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Denda Per Hari</td>
                    <td id="denda">{{$rental->denda_perhari}}</td>
                </tr>
                <tr>
                    <td colspan="2"><strong>Total Pembayaran</strong></td>
                    <td id="total-pembayaran"><strong>{{$rental->total_pembayaran}}</strong></td>
                </tr>
            </tbody>
        </table>

        <div class="ttd-section">
            <div>
                <p>Penyewa,</p>
                <div class="ttd-line"></div>
                <p>({{$rental->Pelanggan->nama_pelanggan}})</p>
            </div>
            <div>
                <p>Petugas,</p>
                <div class="ttd-line"></div>
                <p>(Nama Petugas)</p>
            </div>
        </div>
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
