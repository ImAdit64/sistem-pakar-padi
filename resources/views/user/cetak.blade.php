<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Diagnosa — {{ $sesi->kode_sesi }}</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 13px; color: #333; }
        h1 { color: #166534; }
        table { width: 100%; border-collapse: collapse; margin-top: 12px; }
        th, td { border: 1px solid #ccc; padding: 8px 10px; text-align: left; }
        th { background: #f0fdf4; }
        .progress { background: #dcfce7; height: 10px; border-radius: 4px; }
        .progress-bar { background: #16a34a; height: 10px; border-radius: 4px; }
        @media print { button { display: none; } }
    </style>
</head>
<body>
    <h1>Laporan Hasil Diagnosa Penyakit Tanaman Padi</h1>
    <p>Kode Sesi: <strong>{{ $sesi->kode_sesi }}</strong></p>
    <p>Nama: <strong>{{ $sesi->nama_pengguna }}</strong></p>
    <p>Tanggal: <strong>{{ \Carbon\Carbon::parse($sesi->tanggal)->format('d/m/Y H:i') }}</strong></p>

    <h3>Gejala yang Dipilih:</h3>
    <table>
        <tr><th>Kode</th><th>Gejala</th><th>Keyakinan</th></tr>
        @foreach($sesi->detailGejala as $d)
        <tr>
            <td>{{ $d->gejala->kode }}</td>
            <td>{{ $d->gejala->nama_gejala }}</td>
            <td>{{ $d->bobot_keyakinan }}</td>
        </tr>
        @endforeach
    </table>

    <h3>Hasil Diagnosis:</h3>
    <table>
        <tr><th>No</th><th>Penyakit</th><th>Persentase</th><th>Interpretasi</th></tr>
        @foreach($sesi->hasilDiagnosa as $hasil)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $hasil->penyakit->nama }}</td>
            <td>{{ $hasil->persentase }}%</td>
            <td>{{ $hasil->interpretasi }}</td>
        </tr>
        @endforeach
    </table>

    <br>
    <button onclick="window.print()">🖨️ Cetak / Simpan PDF</button>
</body>
</html>