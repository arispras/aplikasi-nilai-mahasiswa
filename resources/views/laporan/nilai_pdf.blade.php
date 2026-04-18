<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>LAPORAN DATA NILAI MAHASISWA</title>
    <style>
        @page {
            margin: 20px;
        }

        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 11px;
            line-height: 1.3;
        }

        .header {
            text-align: center;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 2px solid #333;
        }

        .header h1 {
            color: #2c3e50;
            margin: 0;
            font-size: 18px;
        }

        .header p {
            color: #7f8c8d;
            margin: 3px 0;
            font-size: 12px;
        }

        .info-box {
            background: #f8f9fa;
            padding: 8px;
            border-radius: 4px;
            margin-bottom: 12px;
            font-size: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            font-size: 9px;
        }

        table th {
            background-color: #2c3e50;
            color: white;
            padding: 6px 4px;
            text-align: center;
            border: 1px solid #ddd;
            font-weight: bold;
        }

        table td {
            padding: 5px 4px;
            border: 1px solid #ddd;
            text-align: center;
        }

        table tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 9px;
            color: #7f8c8d;
            border-top: 1px solid #ddd;
            padding-top: 8px;
        }

        .text-center {
            text-align: center;
        }

        .text-left {
            text-align: left;
        }

        .text-right {
            text-align: right;
        }

        .grade-A {
            background-color: #d4edda !important;
            font-weight: bold;
        }

        .grade-B {
            background-color: #d1ecf1 !important;
        }

        .grade-C {
            background-color: #fff3cd !important;
        }

        .grade-D {
            background-color: #ffeaa7 !important;
        }

        .grade-E {
            background-color: #f8d7da !important;
        }

        .stats {
            display: flex;
            justify-content: space-between;
            margin: 12px 0;
            font-size: 10px;
        }

        .stats div {
            flex: 1;
            text-align: center;
            padding: 4px;
            border: 1px solid #ddd;
            margin: 0 3px;
            background-color: #f8f9fa;
        }

        .stats strong {
            display: block;
            font-size: 14px;
            margin-top: 3px;
        }

        .page-break {
            page-break-before: always;
        }

        .signature {
            margin-top: 30px;
            text-align: right;
        }

        .logo {
            text-align: center;
            margin-bottom: 10px;
        }

        .logo h2 {
            margin: 0;
            color: #2c3e50;
            font-size: 16px;
        }

        .logo p {
            margin: 0;
            color: #7f8c8d;
            font-size: 11px;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <div class="logo">
        <h2>SISTEM INFORMASI NILAI MAHASISWA</h2>
        <p>Laporan Data Nilai - Periode {{ date('Y') }}</p>
    </div>

    <div class="header">
        <h1>LAPORAN DATA NILAI MAHASISWA</h1>
        <p>Tanggal Cetak: {{ date('d/m/Y H:i:s') }}</p>
    </div>

    <!-- Info Box -->
    <div class="info-box">
        <table style="width: 100%; border: none;">
            <tr>
                <td style="border: none; width: 33%;">
                    <strong>Total Data:</strong> {{ $nilais->count() }} nilai
                </td>
                <td style="border: none; width: 33%;">
                    <strong>Rata-rata:</strong> {{ number_format($nilais->avg('nilai_akhir'), 2) }}
                </td>
                <td style="border: none; width: 33%;">
                    <strong>Dicetak oleh:</strong> {{ Auth::user()->name }}
                </td>
            </tr>
        </table>
    </div>

    <!-- Statistics -->
    <div class="stats">
        <div>
            Total Data<br>
            <strong>{{ $nilais->count() }}</strong>
        </div>
        <div>
            Rata-rata<br>
            <strong>{{ number_format($nilais->avg('nilai_akhir'), 2) }}</strong>
        </div>
        <div>
            Grade A<br>
            <strong>{{ $nilais->where('grade', 'A')->count() }}</strong>
        </div>
        <div>
            Grade B<br>
            <strong>{{ $nilais->where('grade', 'B')->count() }}</strong>
        </div>
        <div>
            Grade C/D/E<br>
            <strong>{{ $nilais->whereIn('grade', ['C', 'D', 'E'])->count() }}</strong>
        </div>
    </div>

    <!-- Data Table -->
    <!-- ... kode sebelumnya ... -->

    <table>
        <thead>
            <tr>
                <th width="3%">No</th>
                <th width="10%">NIM</th>
                <th width="12%">Nama Mahasiswa</th>
                <th width="8%">Kode MK</th>
                <th width="15%">Mata Kuliah</th>
                <th width="4%">SKS</th>
                <th width="5%">UTS</th>
                <th width="5%">UAS</th>
                <th width="6%">Tugas</th>
                <th width="8%">Nilai Akhir</th>
                <th width="5%">Grade</th>
                <th width="8%">Jurusan</th>
                <th width="8%">Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @php
            $counter = 1;
            $pageCounter = 1;
            @endphp

            @foreach($nilais as $nilai)
            @if($counter > 25)
        </tbody>
    </table>

    <div class="footer">
        <p>Halaman {{ $pageCounter }}</p>
        <p>© {{ date('Y') }} Aplikasi Nilai Mahasiswa</p>
    </div>

    <div class="page-break"></div>


    <div class="logo">
        <h2>SISTEM INFORMASI NILAI MAHASISWA</h2>
        <p>Laporan Data Nilai - Lanjutan</p>
    </div>

    <div class="header">
        <h1>LAPORAN DATA NILAI MAHASISWA (LANJUTAN)</h1>
        <p>Halaman {{ ++$pageCounter }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th width="3%">No</th>
                <th width="10%">NIM</th>
                <th width="12%">Nama Mahasiswa</th>
                <th width="8%">Kode MK</th>
                <th width="15%">Mata Kuliah</th>
                <th width="4%">SKS</th>
                <th width="5%">UTS</th>
                <th width="5%">UAS</th>
                <th width="6%">Tugas</th>
                <th width="8%">Nilai Akhir</th>
                <th width="5%">Grade</th>
                <th width="8%">Jurusan</th>
                <th width="8%">Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @php
            $counter = 1;
            @endphp
            @endif

            <tr class="grade-{{ $nilai->grade }}">
                <td class="text-center">{{ $loop->iteration }}</td>
                <td>{{ $nilai->mahasiswa->nim }}</td>
                <td class="text-left">{{ $nilai->mahasiswa->nama }}</td>
                <td class="text-center">{{ $nilai->mataKuliah->kode_mk ?? '-' }}</td>
                <td class="text-left">{{ $nilai->mataKuliah->nama_mk ?? '-' }}</td>
                <td class="text-center">{{ $nilai->mataKuliah->sks ?? '-' }}</td>
                <td>{{ $nilai->nilai_uts }}</td>
                <td>{{ $nilai->nilai_uas }}</td>
                <td>{{ $nilai->nilai_tugas }}</td>
                <td><strong>{{ $nilai->nilai_akhir }}</strong></td>
                <td><strong>{{ $nilai->grade }}</strong></td>
                <td>{{ $nilai->mahasiswa->jurusan->nama_jurusan }}</td>
                <td>{{ $nilai->created_at->format('d/m/Y') }}</td>
            </tr>

            @php
            $counter++;
            @endphp
            @endforeach
        </tbody>
    </table>



    <!-- Summary -->
    <div style="margin-top: 15px; padding: 10px; border: 1px solid #ddd; background-color: #f8f9fa;">
        <h4 style="margin: 0 0 10px 0; text-align: center; font-size: 12px;">RINGKASAN STATISTIK</h4>
        <table style="width: 100%; border: none; font-size: 10px;">
            <tr>
                <td style="border: none; width: 25%;">
                    <strong>Total Data:</strong> {{ $nilais->count() }}
                </td>
                <td style="border: none; width: 25%;">
                    <strong>Rata-rata Nilai:</strong> {{ number_format($nilais->avg('nilai_akhir'), 2) }}
                </td>
                <td style="border: none; width: 25%;">
                    <strong>Nilai Tertinggi:</strong> {{ number_format($nilais->max('nilai_akhir'), 2) }}
                </td>
                <td style="border: none; width: 25%;">
                    <strong>Nilai Terendah:</strong> {{ number_format($nilais->min('nilai_akhir'), 2) }}
                </td>
            </tr>
            <tr>
                <td style="border: none;">
                    <strong>Grade A:</strong> {{ $nilais->where('grade', 'A')->count() }}
                </td>
                <td style="border: none;">
                    <strong>Grade B:</strong> {{ $nilais->where('grade', 'B')->count() }}
                </td>
                <td style="border: none;">
                    <strong>Grade C:</strong> {{ $nilais->where('grade', 'C')->count() }}
                </td>
                <td style="border: none;">
                    <strong>Grade D/E:</strong> {{ $nilais->whereIn('grade', ['D', 'E'])->count() }}
                </td>
            </tr>
        </table>
    </div>

    <!-- Footer -->
    <div class="footer">
        <div class="signature">
            <p>Mengetahui,</p>
            <br><br><br>
            <p><strong>Koordinator Akademik</strong></p>
            <p>Sistem Informasi Nilai Mahasiswa</p>
        </div>

        <div style="margin-top: 20px;">
            <p>Halaman {{ $pageCounter }}</p>
            <p>© {{ date('Y') }} Aplikasi Nilai Mahasiswa - Dicetak otomatis oleh sistem</p>
            <p>URL: {{ url()->current() }} | Dicetak: {{ date('d/m/Y H:i:s') }}</p>
        </div>
    </div>
</body>

</html>