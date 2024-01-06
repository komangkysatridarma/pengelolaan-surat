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
            max-width: 400px;
            /* Adjust the width as needed */
            margin: auto;
            /* Center the results div horizontally */
            margin-top: 150px;
            /* Adjust the top margin as needed */
        }

        .img {
            max-width: 600px;
            max-height: 600px;
        }
        .card-img{
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin-top: 150px;
        }
        .container-main{
            display: flex;
            flex-direction: column;
        }

        .results ul li {
            margin-right: 20px;
        }
        .img-results{
            display: flex;
            flex-direction: row;
            margin-left: 200px;
            margin-bottom: 100px;
        }
    </style>
</head>

<body>
<div class="container-main">
    <div id="back-wrap">
        <a href="{{ route('letters.home.guru') }}" class="btn-back" style="margin-right: 10px">Kembali</a>
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
            @if ($result && $result->letter_type)
                <p>No: {{ $result->letter_type->letter_code }} <br>Hal: {{ $result->letter_type->name_type }}</p>
            @else
                <p>Letter type not found</p>
            @endif

            <p>{!! $result->content !!} <br><br>
                Notulis: {{ $result->user->name }} <br><br>
                Guru yang hadir:
                @foreach (json_decode($result->recipients) as $recipientId)
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

    <div class="img-results">

    <div class="card-img">
        @if($result->attachment)
        <h2>Lampiran</h2>
        <img src="{{ asset('storage/' . $result->attachment) }}" alt="" class="img">
        @endif
    </div>

    <div class="results">
        @if($result->meeting_minutes_status === 'Sudah Dibuat')
                <h2>Hasil Rapat</h2>
            @foreach($results as $resultt)
                <p>Peserta Rapat Yang Hadir:</p>
                <ul class="p-0">
                    @php
                        $recipients = json_decode($resultt->presence_recipients, true);
                    @endphp
    
                    @if(is_array($recipients))
                        @foreach($recipients as $recipientId)
                            @php
                                $user = \App\Models\User::find($recipientId);
                            @endphp
                            @if($user)
                                <li>{{ $user->name }}</li>
                            @endif
                        @endforeach
                    @else
                        <li>{{ $recipients }}</li>
                    @endif
                </ul>
                <p>Ringkasan: {!! $resultt->notes !!}</p>
                <!-- Add more fields as needed -->
            @endforeach
        @endif
    </div>
</div>

</div>

</body>

</html>
