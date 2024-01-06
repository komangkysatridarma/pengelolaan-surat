<?php

namespace App\Http\Controllers;

use App\Models\Result;
use App\Models\Letter;
use App\Models\Letter_type;
use App\Models\User;
use PDF;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
{
    // Retrieve results for the given letter ID
    $results = Result::where('letter_id', $id)
        ->with('letter')
        ->get();

    // Check if there are any results
    if ($results->isNotEmpty()) {
        // Retrieve the letter associated with the first result
        $letter = $results->first()->letter;

        return view('results.index', compact('results', 'letter'));
    } else {
        // Handle the case where no results are found
        return view('results.index')->with('message', 'No results found.');
    }
}


    /**
     * Show the form for creating a new resource.
     */

    public function downloadPdf(){
        $results = Result::with('letter')->get();

        // Buat PDF dengan menggunakan view dan results
        $pdf = PDF::loadView('results.index', compact('results'));

        // Download file PDF
        return $pdf->download('file.pdf');
     }


    public function create($id)
    {
        $letter = Letter::find($id);
        $users = User::where('role', 'guru')->get();
        return view('results.create', compact('letter', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'letter_id' => 'nullable|exists:letters,id',
        'presence_recipients' => 'required|array',
        'notes' => 'required|string',
        // Add more validation rules as needed
    ]);

    $selectedRecipients = $request->input('presence_recipients');

    // Konversi array guru yang dipilih menjadi format JSON
    $recipientsJson = json_encode($selectedRecipients);

    // Store the result in the database
    Result::create([
        'letter_id' => $request->letter_id,
        'presence_recipients' => $recipientsJson,
        'notes' => $request->notes,
    ]);

    if ($request->letter_id) {
        $letter = Letter::find($request->letter_id);
        $letter->meeting_minutes_status = 'Sudah Dibuat';
        $letter->save();
    }

    return redirect()->route('letters.home.guru')->with('success', 'Berhasil mengubah data!');
}


    /**
     * Display the specified resource.
     */
    public function show(Result $result)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Result $result)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Result $result)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Result $result)
    {
        //
    }

    public function detail($id)
{
    $letter_types = Letter_type::all();
    $users = User::where('role', 'guru')->get();
    $result = Letter::with('result')->find($id);
    // Check if the letter status is "Sudah Dibuat"
    if ($result->meeting_minutes_status === 'Sudah Dibuat') {
        $results = Result::where('letter_id', $result->id)->get();
        return view('guru.detail', compact('letter_types', 'users', 'result', 'results'));
    }

    return view('guru.detail', compact('letter_types', 'users', 'result'));
}
}
