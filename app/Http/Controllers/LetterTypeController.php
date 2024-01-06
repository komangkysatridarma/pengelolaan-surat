<?php

namespace App\Http\Controllers;

use App\Exports\SuratExport;
use App\Models\Letter_type;
use App\Models\Letter;
use Illuminate\Http\Request;
use Excel;
use PDF;

class LetterTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */

public function index(Request $request)
{
    $query = Letter_type::with('letter');

    // Handle search query
    if ($request->has('search_letter_type')) {
        $searchTerm = $request->input('search_letter_type');
        $query->where('name_type', 'like', '%' . $searchTerm . '%')
        ->orWhere('letter_code', 'like', '%' . $searchTerm . '%');
    }

    $letter_types = $query->simplePaginate(7);

    return view('klarifikasi.index', compact('letter_types'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('klarifikasi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'letter_code' => 'required|min:3',
        'name_type' => 'required',
    ]);

    $baseLetterCode = $request->letter_code;
    $newLetterType = $baseLetterCode;

    // Check if a similar entry already exists
    $countSimilarEntries = Letter_type::where('letter_code', 'LIKE', $baseLetterCode . '%')->count();

    // If similar entries exist, append a numeric suffix
    if ($countSimilarEntries > 0) {
        $newLetterType = $baseLetterCode . '-' . ($countSimilarEntries + 1);
    }

    Letter_type::create([
        'letter_code' => $newLetterType, // Corrected field name
        'name_type' => $request->name_type,
    ]);

    return redirect()->route('klaf.home')->with('success', 'Berhasil menambahkan Surat');
}



    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $letter_type = Letter_type::find($id);
        // or $medicine = Medicine::where('id',$id)->first()

        return view('klarifikasi.edit', compact('letter_type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $request->validate([
        'letter_code' => 'required|min:3',
        'name_type' => 'required',
    ]);

    $baseLetterCode = $request->letter_code;
    $newLetterType = $baseLetterCode;

    // Check if a similar entry already exists
    $countSimilarEntries = Letter_type::where('letter_code', 'LIKE', $baseLetterCode . '%')->where('id', '<>', $id)->count();

    // If similar entries exist, append a numeric suffix
    if ($countSimilarEntries > 0) {
        $newLetterType = $baseLetterCode . '-' . ($countSimilarEntries + 1);
    }

    $letterTypeData = [
        'letter_code' => $newLetterType, // Corrected field name
        'name_type' => $request->name_type,
    ];

    Letter_type::where('id', $id)->update($letterTypeData);

    return redirect()->route('klaf.home')->with('success', 'Berhasil mengubah data Surat');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Letter_type::where('id',$id)->delete();

        return redirect()->back()->with('deleted', 'Berhasil mengahpus data');
    }

    public function excel(){
        $file_name = 'surat'.'.xlsx';
        return Excel::download(new SuratExport, $file_name);
    }

    // LettersController.php

public function detail($id)
{
    $letter_type = Letter_type::findOrFail($id);
    $letters = Letter::where('letter_type_id', $id)->get();

    return view('klarifikasi.detail', compact('letter_type', 'letters'));
}

public function pdf($id)
{
    // Retrieve the Letter by ID with its relations
    $letter = Letter::with('letter_type')->find($id);

    // Pass the data to the PDF view
    $pdf = PDF::loadView('klarifikasi.pdf', compact('letter'));

    // Download the PDF
    return $pdf->download('klasifikasi.pdf');
}



}
