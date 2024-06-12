<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan</title>
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
            font-size: 10px; /* Menambahkan font-size 10px */
        }

        th,
        td {
            border: 1px solid #000;
            padding: 8px;
            text-align: center;
        }

        .wrap-text {
            word-wrap: break-word;
            white-space: normal;
        }

        .page-break {
            page-break-after: always;
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
        <h1>Laporan Transaksi Rental</h1>
    </header>

    <div class="print-button">
        <button onclick="window.print()">Print</button>
    </div>

    <main>
        <p class="text-center">Range tanggal: {{ $tanggal_mulai }} s/d {{ $tanggal_terakhir }}</p>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>No Invoice</th>
                    <th>Tanggal Sewa</th>
                    <th>Tanggal Kembali</th>
                    <th>Nama Alat</th>
                    <th>Nama Pelanggan</th>
                    <th>Lama Sewa</th>
                    <th>Biaya Sewa</th>
                    <th>Status Pembayaran</th>
                    <th>Total Pembayaran</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rental as $index => $data)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $data->no_invoice }}</td>
                    <td>{{ $data->tanggal_sewa }}</td>
                    <td>{{ $data->tanggal_kembali }}</td>
                    <td>{{ $data->Alat->jenis->nama_jenis }} - {{ $data->Alat->merk }} - {{ $data->Alat->type }}</td>
                    <td>{{ $data->Pelanggan->nama_pelanggan }}</td>
                    <td>{{ $data->lama_sewa }}</td>
                    <td>{{ number_format($data->biaya_sewa, 0, ',', '.') }}</td>
                    <td>{{ $data->status_pembayaran }}</td>
                    <td>{{ number_format($data->biaya_sewa, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        
    </main>

   
</body>

</html>
