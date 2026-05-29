<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data Buku</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        h1, p { text-align: center; margin: 0; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #000; padding: 6px 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h1>Data Buku</h1>
    <p>Laporan Data Buku - {{ date('d F Y') }}</p>
    <br/>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Penulis</th>
                <th>Tahun</th>
                <th>Penerbit</th>
                <th>Kota</th>
                <th>Rak</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach($books as $book)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $book->title }}</td>
                <td>{{ $book->author }}</td>
                <td>{{ $book->year }}</td>
                <td>{{ $book->publisher }}</td>
                <td>{{ $book->city }}</td>
                <td>{{ $book->bookshelf->code ?? '-' }}-{{ $book->bookshelf->name ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>