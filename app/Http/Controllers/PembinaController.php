<?php

namespace App\Http\Controllers;

use App\Models\Pembina;
use Illuminate\Http\Request;

class PembinaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pembina = Pembina::all();
        return view('pembina.index', compact('pembina'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pembina.create'); // Mengembalikan view untuk membuat pembina baru
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nip_pembina' => 'required|unique:pembina',
            'nama' => 'required',
            'alamat' => 'required',
            'jenis_kelamin' => 'required',
            'email' => 'required|email',
            'no_hp' => 'required',
        ]);

        Pembina::create($request->all());

        return redirect()->route('pembina.index')
            ->with('success', 'Data pembina berhasil dibuat.');
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
    public function edit(Pembina $pembina)
    {
        return view('pembina.edit', compact('pembina'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pembina $pembina)
    {
        $request->validate([
            'nip_pembina' => 'required|unique:pembina,nip_pembina,' . $pembina->nip_pembina,
            'nama' => 'required',
            'alamat' => 'required',
            'jenis_kelamin' => 'required',
            'email' => 'required|email',
            'no_hp' => 'required',
        ]);

        $pembina->update($request->all());

        return redirect()->route('pembina.index')
            ->with('success', 'Pembina updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pembina $pembina)
    {
        $pembina->delete();

        return redirect()->route('pembina.index')
            ->with('success', 'Pembina deleted successfully.');
    }
}
