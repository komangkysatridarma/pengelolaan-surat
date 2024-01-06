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
        .container{
            max-height: 100vh;
            width: 600px;
            margin: auto;
            margin-top: 100px;
        }
    </style>
</head>
<body>
    <div id="back-wrap">
        <a href="{{ route('letters.home.staff') }}" class="btn-back">Kembali</a>
    </div>
    <div id="back-wrap">
        <a href="{{ route('letters.exportPdf') }}" class="btn-back">Unduh (.pdf)</a>
    </div>
    <div class="container">
    <div class="float-container">
    <div class="header">
        <img src="/img/logo.wk.png" alt="" style="width: 80px; height: 80px;">
    </div>
    <div class="header">
        <p style="margin-top: 30px; margin-left:10px;">SMK WIKRAMA BOGOR</p>
        {{-- <p style="margin-left:10px;">Hal : {{ $letter->letter_type->name_type }}</p> --}}
        </div>
</div>
    <div class="content">
        <p>Yang bertanda tangan di bawah ini:</p>
        <ul>
            {{-- <li>NIS: {{ $student->nis }}</li>
            <li>Nama: {{ $student->name }}</li>
            <li>Rombel: {{ $student->rombel->rombel }}</li>
            <li>Rayon: {{ $student->rayon->rayon }}</li> --}}
        </ul>
        <p>Dengan ini menyatakan bahwa saya telah melakukan pelanggaran tata tertib sekolah, yaitu terlambat datang ke sekolah sebanyak kali yang mana hal tersebut termasuk kedalam pelanggaran kedisplinan. Saya berjanji tidak akan terlambat datang ke sekolah lagi. Apabila saya terlambat datang ke sekolah lagi saya siap diberikan sanksi yang sesuai dengan peraturan sekolah.</p>
        <p>Demikian surat pernyataan ini saya buat dengan penuh penyesalan.</p>
    </div>
<div class="row">
    <div class="col-1">
    <div class="participant">
        <p>Peserta Didik</p>
        {{-- <p class="name">({{ $student->name }})</p> --}}
    </div>
    <div class="counselor">
        <p class="ps">Pembimbing Siswa</p>
        <div class="signature"></div>
        {{-- <p>{{ $student->rayon->user->name }}</p> --}}
    </div>
</div>
    <div class="col-2">
    <div class="footer">
        <p>(Tanggal surat ini dibuat)</p>
        <p>Orang Tua/Wali Peserta Didik</p>
        <div class="signature"></div>
        <p>(....................)</p>
        <p>Kesiswaan</p>
        <div class="signature"></div>
        <p>(....................)</p>
    </div>
    </div>
</div>
</div>
    @if ($letter->meeting_minutes_status == 'Sudah Dibuat') 
</body>
</html>
