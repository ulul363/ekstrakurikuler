<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Ketua;
use Illuminate\Http\Request;
use App\Models\Ekstrakurikuler;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class KetuaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ketua = Ketua::with('user', 'ekstrakurikuler')->get();
        return view('ketua.index', compact('ketua'));
    }

    public function createUser()
    {
        $user = new User();
        return view('ketua.createuser', compact('user'));
    }

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

        $role = Role::where('name', 'Ketua')->first();
        $user->assignRole($role);
        $user->syncPermissions($role->permissions);

        // Store user id and name in session
        $request->session()->put('id_user', $user->id);
        $request->session()->put('user_name', $user->name);

        return redirect()->route('ketua.create');
    }

    public function create(Request $request)
    {
        $id_user = $request->session()->get('id_user');
        $user_name = $request->session()->get('user_name');
        $ekstrakurikuler = Ekstrakurikuler::all();

        return view('ketua.create', compact('id_user', 'user_name', 'ekstrakurikuler'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'ekstrakurikuler_id' => 'required|exists:ekstrakurikuler,id_ekstrakurikuler',
            'nis' => 'required|string|max:20|unique:ketua',
            'nama' => 'required|string|max:50',
            'alamat' => 'required|string|max:50',
            'jk' => 'required|in:L,P',
            'no_hp' => 'required|string|max:15',
        ]);

        // Cek apakah `ekstrakurikuler_id` sudah ada di tabel ketua
        $exists = Ketua::where('ekstrakurikuler_id', $validated['ekstrakurikuler_id'])->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'Ekstrakurikuler ini sudah memiliki ketua.');
        }

        Ketua::create([
            'user_id' => $validated['user_id'],
            'ekstrakurikuler_id' => $validated['ekstrakurikuler_id'],
            'nis' => $validated['nis'],
            'nama' => $validated['nama'],
            'alamat' => $validated['alamat'],
            'jk' => $validated['jk'],
            'no_hp' => $validated['no_hp'],
        ]);

        return redirect()->route('ketua.index')->with('success', 'Ketua berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ketua $ketua)
    {
        return view('ketua.show', compact('ketua'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $ketua = Ketua::with('user', 'ekstrakurikuler')->findOrFail($id);
        $ekstrakurikuler = Ekstrakurikuler::all();
        return view('ketua.edit', compact('ketua', 'ekstrakurikuler'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'ekstrakurikuler_id' => ['required', 'exists:ekstrakurikuler,id_ekstrakurikuler', Rule::unique('ketua')->ignore($id, 'id_ketua')],
            'nis' => 'required|string|max:20|unique:ketua,nis,' . $id . ',id_ketua',
            'nama' => 'required|string|max:50',
            'alamat' => 'required|string|max:50',
            'jk' => 'required|in:L,P',
            'no_hp' => 'required|string|max:15',
        ]);

        $ketua = Ketua::findOrFail($id);
        $ketua->update($validated);

        return redirect()->route('ketua.index')->with('success', 'Data ketua berhasil diperbarui.');
    }

    public function updateUser(Request $request, $user_id)
    {
        $validated = $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::findOrFail($user_id);
        $user->password = Hash::make($validated['password']);
        $user->save();

        // Redirect kembali ke halaman edit ketua
        $ketua = Ketua::where('user_id', $user_id)->first();
        return redirect()
            ->route('ketua.edit', $ketua->id_ketua)
            ->with('success', 'Password user berhasil direset.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $ketua = Ketua::findOrFail($id);

        // Hapus terlebih dahulu pengguna terkait
        $user = User::where('id', $ketua->user_id)->first();
        if ($user) {
            $user->delete();
        }

        // Hapus data ketua setelah pengguna dihapus
        $ketua->delete();

        return redirect()->route('ketua.index')->with('success', 'Data ketua dan akun pengguna berhasil dihapus.');
    }
}