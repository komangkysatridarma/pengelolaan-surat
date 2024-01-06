<?php

namespace App\Http\Controllers;

use App\Models\Letter;
use App\Exports\LetterExport;
use App\Models\Letter_type;
use App\Models\User;
use App\Models\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;
use Excel;

class LettersController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function index(Request $request)
     {
         $query = Letter::with('letter_type', 'user');
     
         // Handle search query
         if ($request->has('search_letters')) {
             $searchTerm = $request->input('search_letters');
             $query->where(function ($query) use ($searchTerm) {
                 $query->where('letter_perihal', 'like', '%' . $searchTerm . '%')
                     ->orWhereHas('letter_type', function ($query) use ($searchTerm) {
                         $query->where('name_type', 'like', '%' . $searchTerm . '%');
                         $query->where('letter_code', 'like', '%' . $searchTerm . '%');
                     })
                     ->orWhereHas('user', function ($query) use ($searchTerm) {
                         $query->where('name', 'like', '%' . $searchTerm . '%');
                     });
                     $searchedUser = User::where('name', 'like', '%' . $searchTerm . '%')->first();

                     if ($searchedUser) {
                         $query->orWhereJsonContains('recipients', [$searchedUser->id]);
                     }
             });
         }
     
         $letters = $query->simplePaginate(10);
     
         return view('letters.index', compact('letters'));
     }
      

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
            $letter_types = Letter_type::all();
            $users = User::where('role', 'guru')->get();
            return view('letters.create', compact('letter_types', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Validasi dan proses lainnya ...
    $request->validate([
        'letter_perihal' => 'required',
        'letter_type_id' => 'required|exists:letter_types,id',
        'content' => 'required',
        'recipients' => 'required',
        'attachment' => 'file|image',
        'user_id' => 'required|exists:users,id',
    ]);

    // Ambil data guru yang dipilih dari input 'recipients'
    $selectedRecipients = $request->input('recipients');

    // Konversi array guru yang dipilih menjadi format JSON
    $recipientsJson = json_encode($selectedRecipients);

    // Check if an attachment file has been uploaded
    if ($request->hasFile('attachment')) {
        // Store the attachment file and get its path
        $attachmentPath = $request->file('attachment')->store('attachment-images');
    
        // Simpan ke database dan ambil ID letter yang baru dibuat
        Letter::create([
            'letter_perihal' => $request->letter_perihal,
            'letter_type_id' => $request->letter_type_id,
            'content' => $request->content,
            'recipients' => $recipientsJson,
            'attachment' => $attachmentPath,
            'user_id' => $request->user_id,
            'meeting_minutes_status' => 'Belum Dibuat',
        ]);
    
    } else {
        // Handle the case when no attachment file is uploaded
        Letter::create([
            'letter_perihal' => $request->letter_perihal,
            'letter_type_id' => $request->letter_type_id,
            'content' => $request->content,
            'recipients' => $recipientsJson,
            'user_id' => $request->user_id,
            'meeting_minutes_status' => 'Belum Dibuat',
        ]);
    }


    $createdLetter = Letter::latest()->first();

    // Redirect to the detail page with the created letter's ID
    return redirect()->route('letters.detail.staff', ['id' => $createdLetter->id])->with('success', 'Berhasil menambahkan Surat');
}



    /**
     * Display the specified resource.
     */
    public function show(Letter $letter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
{
    $letter_types = Letter_type::all();
    $users = User::where('role', 'guru')->get();
    $letter = Letter::find($id);
    $recipients = $letter->recipients;  // Use the array directly, no need to decode

    return view('letters.edit', compact('letter', 'letter_types', 'users', 'recipients'));
}


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $request->validate([
        'letter_perihal' => 'required',
        'letter_type_id' => 'required|exists:letter_types,id',
        'content' => 'required',
        'recipients' => 'required|array', // Ensure recipients is an array
        'user_id' => 'required|exists:users,id',
    ]);

    $selectedRecipients = $request->input('recipients');

    // Konversi array guru yang dipilih menjadi format JSON
    $recipientsJson = json_encode($selectedRecipients);

    Letter::where('id', $id)->update([
        'letter_perihal' => $request->letter_perihal,
        'letter_type_id' => $request->letter_type_id,
        'content' => $request->content,
        'recipients' => $recipientsJson, // Encode the array before storing
        'user_id' => $request->user_id,
    ]);

    return redirect()->route('letters.home.staff')->with('success', 'Berhasil mengubah data!');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Letter::where('id',$id)->delete();

        return redirect()->back()->with('deleted', 'Berhasil mengahpus data');
    }

    public function indexG(Request $request)
    {

        $query = Letter::with('letter_type', 'user');
     
         // Handle search query
         if ($request->has('search_letters_guru')) {
             $searchTerm = $request->input('search_letters_guru');
             $query->where(function ($query) use ($searchTerm) {
                 $query->where('letter_perihal', 'like', '%' . $searchTerm . '%')
                     ->orWhereHas('letter_type', function ($query) use ($searchTerm) {
                         $query->where('name_type', 'like', '%' . $searchTerm . '%');
                         $query->where('letter_code', 'like', '%' . $searchTerm . '%');
                     })
                     ->orWhereHas('user', function ($query) use ($searchTerm) {
                         $query->where('name', 'like', '%' . $searchTerm . '%');
                     });
                     $searchedUser = User::where('name', 'like', '%' . $searchTerm . '%')->first();

                     if ($searchedUser) {
                         $query->orWhereJsonContains('recipients', [$searchedUser->id]);
                     }
             });
         }
     
         $letters = $query->simplePaginate(10);

        return view('guru.letters', compact('letters'));
    }

    // public function createG()
    //     {
    //         $letter_types = Letter_type::all();
    //         $users = User::where('role', 'guru')->get();
        
    //         // Pass an empty array for recipients, as the guru will select them later
    //         $recipients = [];
        
    //         return view('guru.create', compact('users', 'letter_types', 'recipients'));
    //     }
        

    // Validasi dan proses lainnya ...
//     public function storeG(Request $request)
// {
//     // Validasi dan proses lainnya ...
//     $request->validate([
//         'letter_perihal' => 'nullable',
//         'letter_type_id' => 'nullable',
//         'content' => 'required',
//         'recipients' => 'required|array', // Ensure recipients is an array
//         'user_id' => 'nullable',
//     ]);

//     // Ambil data guru yang dipilih dari input 'recipients'
//     $selectedRecipients = $request->input('recipients');

//     // Konversi array guru yang dipilih menjadi format JSON
//     $recipientsJson = json_encode($selectedRecipients);

//     // Ambil data Letter_type berdasarkan 'name_type' yang dipilih
//     $letterType = Letter_type::where('name_type', $request->input('letter_type'))->first();

//     // Ambil data User berdasarkan role 'guru'
//     $user = User::where('role', 'guru')->first();

//     // Check if $letterType and $user are not null
//     if ($letterType && $user) {
//         Letter::create([
//             'recipients' => $recipientsJson,
//             'content' => $request->content,
//             'meeting_minutes_status' => 'Sudah Dibuat',
//             'letter_type_id' => $letterType->id,
//             'user_id' => $user->id,
//         ]);
//     } else {
//         // Handle the case where $letterType or $user is null (e.g., show an error message)
//         return redirect()->back()->with('error', 'Error: Invalid letter type or user.');
//     }

//     return redirect()->route('letters.home.guru')->with('success', 'Berhasil menambahkan Surat');
// }

public function exportPdf()
    {
        // Ambil data dari database (sesuai dengan kebutuhan Anda)
        $data = Letter::with('letter_type', 'user')->get();

        // Buat PDF dengan menggunakan view dan data
        $pdf = PDF::loadView('results.index', compact('data'));

        // Download file PDF
        return $pdf->download('file.pdf');
    }

    public function excel(){
        $file_name = 'letter'.'.xlsx';
        return Excel::download(new LetterExport, $file_name);
    }

    public function detail($id)
{
    $letter_types = Letter_type::all();
    $users = User::where('role', 'guru')->get();
    $letter = Letter::with('result')->find($id);

    // Check if the letter status is "Sudah Dibuat"
    if ($letter->meeting_minutes_status === 'Sudah Dibuat') {
        $results = Result::where('letter_id', $letter->id)->get();
        return view('letters.detail', compact('letter_types', 'users', 'letter', 'results'));
    }

    return view('letters.detail', compact('letter_types', 'users', 'letter'));
}


}