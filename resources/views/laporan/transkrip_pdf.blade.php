<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>TRANSCRIPT - {{ $mahasiswa->nama }}</title>
    <style>
        @page {
            margin: 20px;
        }

        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 12px;
            line-height: 1.4;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #333;
        }

        .header h1 {
            color: #2c3e50;
            margin: 0;
            font-size: 18px;
        }

        .header h2 {
            color: #7f8c8d;
            margin: 5px 0;
            font-size: 16px;
        }

        .student-info {
            margin-bottom: 20px;
        }

        .student-info table {
            width: 100%;
        }

        .student-info td {
            padding: 3px 0;
        }

        .student-info th {
            width: 30%;
            text-align: left;
        }

        .ipk-box {
            border: 2px solid #2c3e50;
            padding: 10px;
            text-align: center;
            margin: 10px 0;
        }

        .ipk-box h3 {
            margin: 0;
            font-size: 14px;
        }

        .ipk-box .ipk-value {
            font-size: 32px;
            font-weight: bold;
            color: #2c3e50;
        }

        table.data {
            width: 100%;
            border-collapse: collapse;
            margin: 15px 0;
            font-size: 10px;
        }

        table.data th {
            background-color: #2c3e50;
            color: white;
            padding: 6px;
            text-align: center;
            border: 1px solid #ddd;
            font-weight: bold;
        }

        table.data td {
            padding: 5px;
            border: 1px solid #ddd;
            text-align: center;
        }

        table.data tr.total {
            background-color: #f8f9fa;
            font-weight: bold;
        }

        .stats {
            display: flex;
            justify-content: space-between;
            margin: 15px 0;
        }

        .stat-box {
            flex: 1;
            text-align: center;
            padding: 10px;
            border: 1px solid #ddd;
            margin: 0 5px;
        }

        .stat-box h4 {
            margin: 0 0 5px 0;
            font-size: 12px;
        }

        .stat-box .value {
            font-size: 20px;
            font-weight: bold;
        }

        .footer {
            margin-top: 30px;
            padding-top: 10px;
            border-top: 1px solid #ddd;
            font-size: 10px;
        }

        .signature {
            margin-top: 50px;
            text-align: right;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .text-left {
            text-align: left;
        }

        .bg-light {
            background-color: #f8f9fa;
        }

        .mb-1 {
            margin-bottom: 5px;
        }

        .mb-2 {
            margin-bottom: 10px;
        }

        .mb-3 {
            margin-bottom: 15px;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>TRANSKRIP NILAI AKADEMIK</h1>
        <h2>SISTEM INFORMASI NILAI MAHASISWA</h2>
        <p>Tanggal Cetak: {{ date('d/m/Y H:i:s') }}</p>
    </div>

    <div class="student-info">
        <table>
            <tr>
                <th>Nama Mahasiswa</th>
                <td>: <strong>{{ $mahasiswa->nama }}</strong></td>
            </tr>
            <tr>
                <th>Nomor Induk Mahasiswa</th>
                <td>: <strong>{{ $mahasiswa->nim }}</strong></td>
            </tr>
            <tr>
                <th>Program Studi</th>
                <td>: {{ $mahasiswa->jurusan->nama_jurusan }}</td>
            </tr>
            <tr>
                <th>Jurusan</th>
                <td>: {{ $mahasiswa->jurusan->nama_jurusan }}</td>
            </tr>
        </table>
    </div>

    <div class="ipk-box">
        <h3>INDEKS PRESTASI KUMULATIF (IPK)</h3>
        <div class="ipk-value">
            @php
            $totalSKS = $mahasiswa->nilais->count() * 3;
            $totalNilai = 0;

            foreach($mahasiswa->nilais as $nilai) {
            $bobot = 0;
            if($nilai->grade == 'A') $bobot = 4.0;
            elseif($nilai->grade == 'B') $bobot = 3.0;
            elseif($nilai->grade == 'C') $bobot = 2.0;
            elseif($nilai->grade == 'D') $bobot = 1.0;
            else $bobot = 0;

            $totalNilai += $bobot * 3;
            }

            $ipk = $totalSKS > 0 ? $totalNilai / $totalSKS : 0;
            @endphp
            {{ number_format($ipk, 2) }}
        </div>
    </div>


    <table class="data">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="15%">Kode MK</th>
                <th width="25%">Mata Kuliah</th>
                <th width="5%">SKS</th>
                <th width="8%">UTS</th>
                <th width="8%">UAS</th>
                <th width="8%">Tugas</th>
                <th width="8%">Akhir</th>
                <th width="8%">Grade</th>
                <th width="10%">Bobot</th>
            </tr>
        </thead>
        <tbody>
            @php
            $totalSKS = 0;
            $totalNilaiSKS = 0;
            @endphp

            @foreach($mahasiswa->nilais as $nilai)
            @php
            $sks = $nilai->mataKuliah ? $nilai->mataKuliah->sks : 0;
            $totalSKS += $sks;

            if($nilai->grade == 'A') $bobot = 4.0;
            elseif($nilai->grade == 'B') $bobot = 3.0;
            elseif($nilai->grade == 'C') $bobot = 2.0;
            elseif($nilai->grade == 'D') $bobot = 1.0;
            else $bobot = 0;

            $nilaiSKS = $bobot * $sks;
            $totalNilaiSKS += $nilaiSKS;
            @endphp
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $nilai->mataKuliah ? $nilai->mataKuliah->kode_mk : '-' }}</td>
                <td class="text-left">{{ $nilai->mataKuliah ? $nilai->mataKuliah->nama_mk : '-' }}</td>
                <td>{{ $sks }}</td>
                <td>{{ $nilai->nilai_uts }}</td>
                <td>{{ $nilai->nilai_uas }}</td>
                <td>{{ $nilai->nilai_tugas }}</td>
                <td>{{ $nilai->nilai_akhir }}</td>
                <td>{{ $nilai->grade }}</td>
                <td>{{ number_format($bobot, 1) }}</td>
            </tr>
            @endforeach

            <tr class="total">
                <td colspan="3" class="text-right">TOTAL</td>
                <td>{{ $totalSKS }}</td>
                <td colspan="5"></td>
                <td>{{ number_format($totalNilaiSKS, 1) }}</td>
            </tr>
        </tbody>
    </table>

    <!-- ... kode setelahnya ... -->

    <div class="stats">
        <div class="stat-box">
            <h4>Rata-rata Nilai</h4>
            <div class="value text-primary">
                {{ number_format($mahasiswa->nilais->avg('nilai_akhir') ?? 0, 2) }}
            </div>
        </div>
        <div class="stat-box">
            <h4>Total Mata Kuliah</h4>
            <div class="value text-success">
                {{ $mahasiswa->nilais->count() }}
            </div>
        </div>
        <div class="stat-box">
            <h4>Total SKS</h4>
            <div class="value text-warning">
                {{ $totalSKS }}
            </div>
        </div>
    </div>

    <div class="footer">
        <div class="row">
            <div class="text-left" style="width: 50%;">
                <p><strong>Informasi Cetak:</strong></p>
                <p class="mb-1">Dicetak oleh: {{ Auth::user()->name }}</p>
                <p class="mb-1">Tanggal: {{ date('d/m/Y') }}</p>
                <p class="mb-0">Waktu: {{ date('H:i:s') }}</p>
            </div>
            <div class="signature" style="width: 50%;">
                <p>Mengetahui,</p>
                <br><br><br>
                <p><strong>Kepala Jurusan</strong></p>
                <p>{{ $mahasiswa->jurusan->nama_jurusan }}</p>
            </div>
        </div>

        <div class="text-center mt-3">
            <p>© {{ date('Y') }} Aplikasi Nilai Mahasiswa - Halaman 1</p>
        </div>
    </div>
</body>

</html>