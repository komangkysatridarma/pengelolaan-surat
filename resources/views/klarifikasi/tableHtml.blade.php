<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Data</title>
</head>
<body>

<table border="1">
    <thead>
        <tr>
            <th>No</th>
            <th>Kode Surat</th>
            <th>Klasifikasi Surat</th>
            <th>Surat Tertaut</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($letter_types as $lt)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $lt->letter_code }}</td>
                <td>{{ $lt->name_type }}</td>
                <td>{{ \App\Models\Letter::countUsageByType($lt->id) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
