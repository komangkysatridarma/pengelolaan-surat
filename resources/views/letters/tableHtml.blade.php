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
            <th>Perihal</th>
            <th>Tanggal Keluar</th>
            <th>Penerima Surat</th>
            <th>Notulis</th>
            <th>Hasil Rapat</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($letter as $lt)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $lt->letter_type->letter_code }}</td>
                <td>{{ $lt->letter_perihal }}</td>
                <td>{{ $lt->created_at->format('d M Y') }}</td>
                <td>@foreach (json_decode($lt->recipients) as $recipientId)
                    @php
                        $recipient = \App\Models\User::find($recipientId);
                    @endphp
                    @if ($recipient)
                        {{ $recipient->name }}
                    @else
                        User not found
                    @endif
                @endforeach
                </td>
                <td>{{ $lt->user->name }}</td>
                <td>@if ($lt->meeting_minutes_status == 'Belum Dibuat')
                    Hasil Rapat Belum Dibuat
                 @else
                     Hasil Rapat Sudah Dibuat
                 @endif</td>
            </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
