<?php

namespace App\Exports;

use App\Models\Letter_type;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class SuratExport implements FromView
{
    public function view(): View
    {
        $letter_types = Letter_type::with('letter')->get();
        return view('klarifikasi.tableHtml', compact('letter_types'));
    }
}
