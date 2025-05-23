<!DOCTYPE html>
<html lang="id">

<head>
   <meta charset="UTF-8">
   <title>Invoice Pembayaran</title>
   <style>
      body {
         font-family: sans-serif;
         font-size: 12px;
         color: #000;
         width: 210mm;
         height: 297mm;
         margin: 0 auto;
         padding: 10mm;
      }

      .header {
         text-align: center;
         margin-bottom: 20px;
      }

      .info {
         margin-bottom: 20px;
      }

      .info p {
         margin: 4px 0;
      }

      table {
         width: 100%;
         border-collapse: collapse;
         margin-bottom: 20px;
      }

      th,
      td {
         padding: 6px;
         border: 1px solid #000;
         text-align: left;
      }

      .right {
         text-align: right;
      }

      .footer {
         margin-top: 40px;
         font-size: 11px;
         text-align: center;
         border-top: 1px solid #ccc;
         padding-top: 10px;
      }

      .status {
         font-size: 14px;
         font-weight: bold;
         text-align: right;
         margin-top: 10px;
      }
   </style>
</head>

<body>
   <div class="header">
      <h2>INVOICE PEMBAYARAN</h2>
      <p>Tanggal Cetak: {{ now()->translatedFormat('d F Y') }}</p>
   </div>

   <div style="display: flex; justify-content: space-between;">
      <div class="info" style="flex: 1;">
         <h4>Data Jemaah</h4>
         <p>
            <!-- <strong>Nama Jemaah:</strong> -->
            {{ $jemaah->bioJemaah->nama_lengkap ?? '-' }}
         </p>
         <p>
            <!-- <strong>Nomor HP:</strong> -->
            {{ $jemaah->no_hp ?? '-' }}
         </p>
      </div>

      <div class="info" style="flex: 1; text-align: right;">
         <h4>Detail Paket</h4>
         <p>
            {{ $jemaah->group->paket->nama ?? '-' }}
            <!-- <strong>Nama Paket:</strong> -->
         </p>

         <p>
            {{ $jemaah->group->nama ?? '-' }} |
            {{ \Carbon\Carbon::parse($jemaah->group->tanggal_keberangkatan)->format('d F Y') ?? '-' }}
            <!-- <strong>Tanggal Keberangkatan:</strong> -->
         </p>
         <p>
            Rp {{ number_format($hargaPaket, 0, ',', '.') }}
            <!-- <strong>Harga Paket:</strong> -->
         </p>
      </div>
   </div>

   <h4>Rincian Pembayaran</h4>
   <table>
      <thead>
         <tr>
            <th>Tanggal</th>
            <th>Metode</th>
            <th>Status</th>
            <th class="right">Jumlah (Rp)</th>
         </tr>
      </thead>
      <tbody>
         @forelse ($jemaah->pembayaran as $pembayaran)
         <tr>
            <td>{{ \Carbon\Carbon::parse($pembayaran->created_at)->format('d-m-Y') }}</td>
            <td>{{ ucfirst($pembayaran->method) }}</td>
            <td>{{ ucfirst($pembayaran->status) }}</td>
            <td class="right">{{ number_format($pembayaran->harga, 0, ',', '.') }}</td>
         </tr>
         @empty
         <tr>
            <td colspan="4" class="right">Belum ada pembayaran</td>
         </tr>
         @endforelse
      </tbody>
      <tfoot>
         <tr>
            <th colspan="3" class="right">Total Bayar:</th>
            <th class="right">Rp {{ number_format($totalBayar, 0, ',', '.') }}</th>
         </tr>
      </tfoot>
   </table>

   <div class="status">
      Status Pembayaran:
      @if ($totalBayar >= $hargaPaket)
      <span style="color: green;">LUNAS</span>
      @else
      <span style="color: red;">BELUM LUNAS</span>
      @endif
   </div>

   <div class="footer">
      <p>Invoice ini dikeluarkan oleh:</p>
      <p><strong>{{$namaPerusahaan}}</strong></p>
      <p>{{$webPerusahaan}} | {{$emailPerusahaan}}</p>
      <p>Telp: {{$noTelpPerusahaan}}</p>
   </div>
</body>

</html>