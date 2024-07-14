<?php

namespace App\Http\Controllers;

use App\Models\Ketua;
use App\Models\Ekstrakurikuler;
use App\Models\User;
use Illuminate\Http\Request;

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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        $ekstrakurikuler = Ekstrakurikuler::all();
        return view('ketua.create', compact('users', 'ekstrakurikuler'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'ekstrakurikuler_id' => 'required|exists:ekstrakurikuler,id_ekstrakurikuler|unique:ketua,ekstrakurikuler_id',
            'nis' => 'required|string|max:20|unique:ketua,nis',
            'nama' => 'required|string|max:50',
            'alamat' => 'required|string|max:50',
            'jk' => 'required|in:L,P',
            'no_hp' => 'required|string|max:15',
        ]);

        Ketua::create($request->all());

        return redirect()->route('ketua.index')->with('success', 'Ketua berhasil ditambahkan.');
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
    public function edit(Ketua $ketua)
    {
        $users = User::all();
        $ekstrakurikulers = Ekstrakurikuler::all();
        return view('ketua.edit', compact('ketua', 'users', 'ekstrakurikulers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ketua $ketua)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'ekstrakurikuler_id' => 'required|exists:ekstrakurikuler,id_ekstrakurikuler|unique:ketua,ekstrakurikuler_id,'.$ketua->id_ketua.',id_ketua',
            'nis' => 'required|string|max:20|unique:ketua,nis,'.$ketua->id_ketua.',id_ketua',
            'nama' => 'required|string|max:50',
            'alamat' => 'required|string|max:50',
            'jk' => 'required|in:L,P',
            'no_hp' => 'required|string|max:15',
        ]);

        $ketua->update($request->all());

        return redirect()->route('ketua.index')->with('success', 'Ketua berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ketua $ketua)
    {
        $ketua->delete();
        return redirect()->route('ketua.index')->with('success', 'Ketua berhasil dihapus.');
    }
}