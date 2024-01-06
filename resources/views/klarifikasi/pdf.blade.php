<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Pernyataan</title>
    <style>
        #back-wrap{
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
        .name{
            margin-top: 20px;
            margin-bottom: 10px;
        }
        .row{
            display: flex;
            justify-content: space-between;
        }
        .col-1{
            display: flex;
            flex-direction: column;
        }
        .col-1{
            display: flex;
            flex-direction: column;
        }
        .ps{
            margin-bottom: 20px;
        }
        .img{
            float: left;
        }
        .float-container{
            display: flex;
        }
        .recipient-name {
            display: block; 
        }
    </style>
</head>
<body>
    <div class="float-container">
    <div class="header">
        <img src="{{ public_path('/img/logo.wk.png') }}" alt="" style="width: 80px; height: 80px;">
    </div>
    <div class="header">
        <p style="margin-top: 30px; margin-left:10px;">SMK WIKRAMA BOGOR</p>
        {{-- <p style="margin-left:10px;">Hal : {{ $letter->letter_type_id->name_type }}</p> --}}
        </div>
    </div>
 
<div class="row">
    @if ($letter && $letter->letter_type)
        <p style="margin-left:10px;">No: {{ $letter->letter_type->letter_code }}</p>
        <p style="margin-left:10px;">Hal: {{ $letter->letter_type->name_type }}</p>
    @else
        <p style="margin-left:10px;">Letter type not found</p>
    @endif

</div>
</div>
    <div class="col-2">
    <div class="footer">
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
             <br><br></p><br><br><br>
        <p>Hormat kami,</p>
        <p>Kepala SMK WIKRAMA BOGOR</p>
        <div class="signature"></div>
        <p>(....................)</p>
    </div>
    </div>
</div>
</body>
</html>
