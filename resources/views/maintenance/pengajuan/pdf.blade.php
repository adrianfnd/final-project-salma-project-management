<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Jalan - {{ $surat_jalan->nomor_surat }}</title>
    <style>
        @page {
            margin: 0;
        }

        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }

        .container {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            background-color: #1c3782;
            color: white;
            text-align: center;
            padding: 20px;
        }

        .logo {
            max-width: 150px;
            margin-bottom: 10px;
        }

        h1 {
            margin: 0;
            font-size: 24px;
        }

        .content {
            padding: 20px;
        }

        .section {
            margin-bottom: 20px;
            background-color: #f9f9f9;
            border-radius: 5px;
            padding: 15px;
        }

        .section h2 {
            color: #1c3782;
            border-bottom: 2px solid #1c3782;
            padding-bottom: 5px;
            margin-top: 0;
            margin-bottom: 15px;
            font-size: 18px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #e6e6e6;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>SURAT JALAN</h1>
            <p>Nomor: {{ $surat_jalan->nomor_surat }}</p>
        </div>

        <div class="content">
            <div class="section">
                <h2>Informasi Proyek</h2>
                <table>
                    <tr>
                        <th>Nama Proyek</th>
                        <td>{{ $surat_jalan->project->project_name }}</td>
                    </tr>
                    <tr>
                        <th>OLT Hostname</th>
                        <td>{{ $surat_jalan->project->olt_hostname }}</td>
                    </tr>
                    <tr>
                        <th>No SP2K/SPA</th>
                        <td>{{ $surat_jalan->project->no_sp2k_spa }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Mulai</th>
                        <td>{{ $surat_jalan->project->start_date }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Selesai</th>
                        <td>{{ $surat_jalan->project->end_date }}</td>
                    </tr>
                </table>
            </div>

            <div class="section">
                <h2>Informasi Pelanggan</h2>
                <table>
                    <tr>
                        <th>Nama</th>
                        <td>{{ $surat_jalan->customer->name }}</td>
                    </tr>
                    <tr>
                        <th>Telepon</th>
                        <td>{{ $surat_jalan->customer->phone }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $surat_jalan->customer->email }}</td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td>{{ $surat_jalan->customer->address }}</td>
                    </tr>
                </table>
            </div>

            <div class="section">
                <h2>Informasi Vendor</h2>
                <table>
                    <tr>
                        <th>Nama Vendor</th>
                        <td>{{ $surat_jalan->vendor->name }}</td>
                    </tr>
                    <tr>
                        <th>Kontak Person</th>
                        <td>{{ $surat_jalan->vendor->contact_person }}</td>
                    </tr>
                    <tr>
                        <th>Telepon</th>
                        <td>{{ $surat_jalan->vendor->phone }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $surat_jalan->vendor->email }}</td>
                    </tr>
                </table>
            </div>

            <div class="section">
                <h2>Informasi Teknisi</h2>
                <table>
                    <tr>
                        <th>Nama Teknisi</th>
                        <td>{{ $surat_jalan->technician->name }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $surat_jalan->technician->email }}</td>
                    </tr>
                </table>
            </div>

            <div class="section">
                <h2>Deskripsi Pekerjaan</h2>
                <p>{{ $surat_jalan->deskripsi }}</p>
            </div>
        </div>
    </div>
</body>

</html>
