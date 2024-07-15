<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pembina;
use Illuminate\Http\Request;
use App\Models\Ekstrakurikuler;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class PembinaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pembina = Pembina::with('user', 'ekstrakurikuler')->get();
        return view('pembina.index', compact('pembina'));
    }

    /**
     * Show the form for creating a new user.
     */
    public function createUser()
    {
        $user = new User();
        return view('pembina.createuser', compact('user'));
    }

    /**
     * Store a newly created user in storage.
     */
    public function storeUser(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // Simpan id pengguna dan nama di sesi
        $request->session()->put('id_user', $user->id);
        $request->session()->put('user_name', $user->name);

        // Redirect ke form kedua
        return redirect()->route('pembina.create');
    }

    /**
     * Show the form for creating a new Pembina.
     */
    public function create(Request $request)
    {
        $id_user = $request->session()->get('id_user');
        $user_name = $request->session()->get('user_name');
        $ekstrakurikuler = Ekstrakurikuler::all();

        return view('pembina.create', compact('id_user', 'user_name', 'ekstrakurikuler'));
    }

    /**
     * Store a newly created Pembina in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'ekstrakurikuler_id' => 'required|exists:ekstrakurikuler,id_ekstrakurikuler',
            'nip' => 'required|string|max:20|unique:pembina',
            'nama' => 'required|string|max:50',
            'alamat' => 'required|string|max:50',
            'jk' => 'required|in:L,P',
            'no_hp' => 'required|string|max:15',
        ]);

        // Cek apakah ekstrakurikuler_id sudah ada di tabel pembina
        $exists = Pembina::where('ekstrakurikuler_id', $validated['ekstrakurikuler_id'])->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'Ekstrakurikuler ini sudah memiliki pembina.');
        }

        Pembina::create([
            'user_id' => $validated['user_id'],
            'ekstrakurikuler_id' => $validated['ekstrakurikuler_id'],
            'nip' => $validated['nip'],
            'nama' => $validated['nama'],
            'alamat' => $validated['alamat'],
            'jk' => $validated['jk'],
            'no_hp' => $validated['no_hp'],
        ]);

        return redirect()->route('pembina.index')->with('success', 'Pembina berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pembina $pembina)
    {
        return view('pembina.show', compact('pembina'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pembina = Pembina::findOrFail($id);
        $ekstrakurikuler = Ekstrakurikuler::all();
        return view('pembina.edit', compact('pembina', 'ekstrakurikuler'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'ekstrakurikuler_id' => [
                'required',
                'exists:ekstrakurikuler,id_ekstrakurikuler',
                Rule::unique('pembina')->ignore($id, 'id_pembina'),
            ],
            'nip' => 'required|string|max:20|unique:pembina,nip,' . $id . ',id_pembina',
            'nama' => 'required|string|max:50',
            'alamat' => 'required|string|max:50',
            'jk' => 'required|in:L,P',
            'no_hp' => 'required|string|max:15',
        ]);

        $pembina = Pembina::findOrFail($id);
        $pembina->update($validated);

        return redirect()->route('pembina.index')->with('success', 'Data pembina berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pembina $pembina)
    {
        $pembina->delete();
        return redirect()->route('pembina.index')->with('success', 'Pembina berhasil dihapus.');
    }
}
