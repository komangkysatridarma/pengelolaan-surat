<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Pernyataan</title>
    <style>
        #back-wrap {
            margin: 30px auto 0 auto;
            width: 500px;
            display: flex;
            justify-content: flex-end;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .title {
            text-align: center;
            font-weight: bold;
            font-size: 18px;
            color: black;
            margin-bottom: 20px;

        }

        .content {
            margin-bottom: 20px;
        }

        .signature {
            margin-top: 50px;
            width: 200px;
            text-align: center;
            margin-left: auto;
            margin-right: auto;
        }

        .footer {
            margin-top: 50px;
        }

        ul li {
            list-style: none;
        }

        .name {
            margin-top: 20px;
            margin-bottom: 10px;
        }

        .row {
            display: flex;
            justify-content: space-between;
        }

        .col-1 {
            display: flex;
            flex-direction: column;
        }

        .col-2 {
            float: right;
            flex-direction: column;
        }

        .col-1 {
            display: flex;
            flex-direction: column;
        }

        .ps {
            margin-bottom: 20px;
        }

        .img {
            float: left;
        }

        .float-container {
            display: flex;
        }

        .container {
            max-height: 100vh;
            width: 600px;
            margin: auto;
            margin-top: 100px;
        }

        .recipient-name {
            display: block;
        }

        .results {
            max-width: 600px;
            /* Adjust the width as needed */
            margin: auto;
            /* Center the results div horizontally */
            margin-top: 20px;
            /* Adjust the top margin as needed */
        }
    </style>
</head>

<body>
    <div id="back-wrap">
        <a href="{{ route('letters.home.staff') }}" class="btn-back" style="margin-right: 10px">Kembali</a>
        <a href="{{ route('letters.exportPdf') }}" class="btn-back">Unduh (.pdf)</a>
    </div>
    <div class="container">
        <div class="float-container">
            <div class="header">
                <img src="/img/logo.wk.png" alt="" style="width: 80px; height: 80px; margin-top:8px;">
            </div>
            <div class="header">
                <p style="margin-bottom: 10px; margin-left:10px;"><span style="font-weight: 700; ">SMK WIKRAMA
                        BOGOR</span><br> Manajemen dan Bisnis<br>Teknik Informasi dan Komunikasi<br>Pemasaran</p>
                {{-- <p style="margin-left:10px;">Hal : {{ $letter->letter_type->name_type }}</p> --}}
            </div>
        </div>
        <hr>
        <div class="content">
            @if ($letter && $letter->letter_type)
                <p>No: {{ $letter->letter_type->letter_code }} <br>Hal: {{ $letter->letter_type->name_type }}</p>
            @else
                <p>Letter type not found</p>
            @endif
            <ul>
                {{-- <li>NIS: {{ $student->nis }}</li>
            <li>Nama: {{ $student->name }}</li>
            <li>Rombel: {{ $student->rombel->rombel }}</li>
            <li>Rayon: {{ $student->rayon->rayon }}</li> --}}
            </ul>
            <p>{!! $letter->content !!} <br><br>
                Notulis: {{ $letter->user->name }} <br><br>
                Guru yang hadir:
                @foreach (json_decode($letter->recipients) as $recipientId)
                    @php
                        $recipient = \App\Models\User::find($recipientId);
                    @endphp
                    @if ($recipient)
                        <span class="recipient-name">-{{ $recipient->name }}</span>
                    @else
                        User not found<br>
                    @endif
                @endforeach
                <br><br>
            </p><br><br><br>
        </div>
        <div class="col-2">
            <div class="footer">
                <p>Hormat Kami,</p>
                <p>Kepala SMK Wikrama Bogor </p>
                <div class="signature"></div>
                <p>(....................)</p>
                {{-- <div class="signature"></div>
            <p>(....................)</p> --}}
            </div>
        </div>

    </div>
    <div class="results">
        @if ($letter->meeting_minutes_status === 'Sudah Dibuat')
            <h2>Hasil Rapat</h2>
            @foreach ($results as $result)
                <p>Peserta Rapat Yang Hadir:</p>
                <ul>
                    @php
                        $recipients = json_decode($result->presence_recipients, true);
                    @endphp

                    @if (is_array($recipients))
                        @foreach ($recipients as $recipientId)
                            @php
                                $user = \App\Models\User::find($recipientId);
                            @endphp
                            @if ($user)
                                <li>{{ $user->name }}</li>
                            @endif
                        @endforeach
                    @else
                        <li>{{ $recipients }}</li>
                    @endif
                </ul>
                <p>Ringkasan: {!! $result->notes !!}</p>
                <!-- Add more fields as needed -->
            @endforeach
        @endif
    </div>
</body>

</html>
