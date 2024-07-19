<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pembina;
use Illuminate\Http\Request;
use App\Models\Ekstrakurikuler;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

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

    public function createUser()
    {
        $user = new User();
        return view('pembina.createuser', compact('user'));
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

        $role = Role::where('name', 'Pembina')->first();
        $user->assignRole($role);
        $user->syncPermissions($role->permissions);

        // Store user id and name in session
        $request->session()->put('id_user', $user->id);
        $request->session()->put('user_name', $user->name);

        return redirect()->route('pembina.create');
    }

    public function create(Request $request)
    {
        $id_user = $request->session()->get('id_user');
        $user_name = $request->session()->get('user_name');
        $ekstrakurikuler = Ekstrakurikuler::all();

        return view('pembina.create', compact('id_user', 'user_name', 'ekstrakurikuler'));
    }

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
        $pembina = Pembina::with('user', 'ekstrakurikuler')->findOrFail($id);
        $ekstrakurikuler = Ekstrakurikuler::all();
        return view('pembina.edit', compact('pembina', 'ekstrakurikuler'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'ekstrakurikuler_id' => ['required', 'exists:ekstrakurikuler,id_ekstrakurikuler'],
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

    public function updateUser(Request $request, $user_id)
    {
        $validated = $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::findOrFail($user_id);
        $user->password = Hash::make($validated['password']);
        $user->save();

        // Redirect kembali ke halaman edit pembina
        $pembina = Pembina::where('user_id', $user_id)->first();
        return redirect()
            ->route('pembina.edit', $pembina->id_pembina)
            ->with('success', 'Password user berhasil direset.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pembina = Pembina::findOrFail($id);
        $user = User::findOrFail($pembina->user_id);

        // Menghapus user terlebih dahulu
        $user->delete();

        // Menghapus pembina setelah user dihapus
        $pembina->delete();

        return redirect()->route('pembina.index')->with('success', 'Data pembina dan akun pengguna berhasil dihapus.');
    }
}
