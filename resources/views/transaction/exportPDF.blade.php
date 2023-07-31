<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan</title>
    <style>
        table {
            border-collapse: collapse;
        }

        table th {
            padding:5px;
        }

        table td {
            padding:5px;
        }

        tfoot {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h3>Laporan Penjualan Barang</h3>
    <table border="1" width="100%">
        <thead>
            <tr>
                <th style="text-align:center">No</th>
                <td style="text-align:center">Tanggal Transaksi</td>
                <th style="text-align:center">Order ID</th>
                <th style="text-align:center">Nama Barang</th>
                <th style="text-align:center">Harga</th>
                <th style="text-align:center">Jumlah</th>
                <th style="text-align:center">Pengrajin</th>
                <th style="text-align:center">Total</th>
            </tr>
        </thead>
        <tbody>
            @php
                $total = 0;
                $jumlah = 0;
            @endphp
            @foreach ($list as $data)
            @php
                $jumlah += $data->qty;
                $total += $data->qty * $data->price;
            @endphp
            <tr>
                <td style="text-align:center">{{ $loop->iteration }}</td>
                <td style="text-align:center">{{ date('d-m-Y', strtotime($data->transaction_date)) }}</td>
                <td style="text-align:center">{{ $data->order_id }}</td>
                <td style="text-align:center">{{ $data->nama_barang }}</td>
                <td style="text-align:center">Rp {{ number_format($data->price,0,',','.') }}</td>
                <td align="center">{{ $data->qty }}</td>
                <td style="text-align:center">{{ $data->nama_pengrajin }}</td>
                <td style="text-align:center">Rp {{ number_format($data->qty * $data->price,0,',','.') }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="6">TOTAL</td>
                <td align="center">{{ $jumlah }}</td>
                <td style="text-align:center">Rp {{ number_format($total,0,',','.') }}</td>
            </tr>
        </tfoot>
    </table>
    

    
</body>
</html>