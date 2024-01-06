<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function indexSt(Request $request)
{
    $query = User::where('role', 'staff');

    if ($request->has('search_staff')) {
        $searchTerm = $request->input('search_staff');
        $query->where(function ($query) use ($searchTerm) {
            $query->where('name', 'like', '%' . $searchTerm . '%')
                ->orWhere('email', 'like', '%' . $searchTerm . '%');
        });
    }

    $usersSt = $query->simplePaginate(7);

    return view('users.staff.index', compact('usersSt'));
}



    /**
     * Show the form for creating a new resource.
     */
    public function createSt()
    {
        return view('users.staff.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeSt(Request $request)
{
    // Validasi input
    $request->validate([
        'name' => 'required|min:3',
        'email' => 'required|email:dns',
    ]);

    // Ambil 3 karakter pertama dari email
    $emailPart = substr($request->email, 0, 3);

    // Ambil 3 karakter pertama dari nama
    $namePart = substr($request->name, 0, 3);

    // Gabungkan kedua bagian untuk membentuk kata sandi
    $password = strtolower($emailPart . $namePart . rand(100, 999));

    // Enkripsi kata sandi menggunakan bcrypt
    $hashedPassword = Hash::make($password);

    // Buat pengguna baru dengan peran "staff"
    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => $hashedPassword,
        'role' => 'staff', // Tetapkan peran secara otomatis ke "staff"
    ]);

    return redirect()->route('users.staff.home')->with('success', 'Berhasil menambahkan Staff!');
}


    /**
     * Display the specified resource.
     */
    public function show(User $User)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editSt(string $id)
    {
        $user = User::find($id);
        // or $medicine = Medicine::where('id',$id)->first()

        return view('users.staff.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateSt(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email:dns',
            'password' => 'required',
        ]);


        $userData = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if ($request->filled('password')) {
            // Jika ya, hash password baru
            $hashedPassword = Hash::make($request->password);
            $userData['password'] = $hashedPassword;
        }
    
        User::where('id', $id)->update($userData);

        return redirect()->route('users.staff.home')->with('success', 'Berhasil mengubah data!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroySt($id)
    {
        User::where('id',$id)->delete();

        return redirect()->back()->with('deleted', 'Berhasil mengahpus data');
    }



    public function indexG(Request $request)
    {

        $query = User::where('role', 'guru');

        if ($request->has('search_guru')) {
            $searchTerm = $request->input('search_guru');
            $query->where(function ($query) use ($searchTerm) {
                $query->where('name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('email', 'like', '%' . $searchTerm . '%');
            });
        }

        $usersG = $query->simplePaginate(7);

        return view('users.guru.index', compact('usersG'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createG()
    {
        return view('users.guru.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeG(Request $request)
{
    // Validasi input
    $request->validate([
        'name' => 'required|min:3',
        'email' => 'required|email:dns',
    ]);

    // Ambil 3 karakter pertama dari email
    $emailPart = substr($request->email, 0, 3);

    // Ambil 3 karakter pertama dari nama
    $namePart = substr($request->name, 0, 3);

    // Gabungkan kedua bagian untuk membentuk kata sandi
    $password = strtolower($emailPart . $namePart . rand(100, 999));

    // Enkripsi kata sandi menggunakan bcrypt
    $hashedPassword = Hash::make($password);

    // Buat pengguna baru dengan peran "staff"
    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => $hashedPassword,
        'role' => 'guru',
        // 'role' => 'guru' // Tetapkan peran secara otomatis ke "staff"
    ]);

    return redirect()->route('users.guru.home')->with('success', 'Berhasil menambahkan Guru!');
}


    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function editG(string $id)
    {
        $user = User::find($id);
        // or $medicine = Medicine::where('id',$id)->first()

        return view('users.guru.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateG(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email:dns',
            'password' => 'required',
        ]);


        $userData = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if ($request->filled('password')) {
            // Jika ya, hash password baru
            $hashedPassword = Hash::make($request->password);
            $userData['password'] = $hashedPassword;
        }
    
        User::where('id', $id)->update($userData);

        return redirect()->route('users.guru.home')->with('success', 'Berhasil mengubah data!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyG($id)
    {
        User::where('id',$id)->delete();

        return redirect()->back()->with('deleted', 'Berhasil mengahpus data');
    }

    public function loginAuth(Request $request){
        $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required',
        ]);

        $user = $request->only(['email', 'password']);
        if(Auth::attempt($user)){
            return redirect()->route('dashboard.page');
        }else{
            return redirect()->back()->with('failed', 'Proses login gagal, silahkan coba kembali dengan data yang benar!');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login')->with('logout', 'Anda telah logout!');
    }
}
