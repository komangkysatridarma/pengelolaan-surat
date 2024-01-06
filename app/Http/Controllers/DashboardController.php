<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Letter;
use App\Models\User;
use App\Models\Letter_type;

class DashboardController extends Controller
{
    public function countLettersToday()
{
    // Hitung jumlah surat pada hari ini
    $countLettersToday = Letter::whereDate('created_at', today())->count();

    // Tampilkan jumlah surat pada hari ini
    return view('guru.index', compact('countLettersToday'));
}

    public function index()
{
    $totalLetter= Letter::count();
    $totalLetter_type= Letter_type::count();
    $totalStaff = User::where('role', 'staff')->count();
    $totalGuru = User::where('role', 'guru')->count();
    return view('countDash.index', compact('totalLetter', 'totalLetter_type', 'totalStaff', 'totalGuru'));
}
}
