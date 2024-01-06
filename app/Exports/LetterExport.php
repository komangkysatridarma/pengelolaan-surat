<?php

namespace App\Exports;

use App\Models\Letter;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class LetterExport implements FromView
{
    public function view(): View
    {
        $letter = Letter::with('letter_type', 'user')->get();
        return view('letters.tableHtml', compact('letter'));
    }
}
