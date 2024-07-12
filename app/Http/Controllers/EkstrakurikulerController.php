<?php

namespace App\Http\Controllers;

use App\Models\Ekstrakurikuler;
use App\Models\Pembina;
use Illuminate\Http\Request;

class EkstrakurikulerController extends Controller
{
    public function index()
    {
        $ekstrakurikuler = Ekstrakurikuler::all();
        return view('ekstrakurikuler.index', compact('ekstrakurikuler'));
    }

    public function create()
    {
        $pembina = Pembina::all();
        return view('ekstrakurikuler.create', compact('pembina'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nip_pembina' => 'required|exists:pembina,nip_pembina',
            'nama_ekstrakurikuler' => 'required',
            'nama' => 'required',
        ]);

        Ekstrakurikuler::create($request->all());

        return redirect()->route('ekstrakurikuler.index')
            ->with('success', 'Data ekstrakurikuler berhasil dibuat.');
    }

    public function show(Ekstrakurikuler $ekstrakurikuler)
    {
        return view('ekstrakurikuler.show', compact('ekstrakurikuler'));
    }

    public function edit(Ekstrakurikuler $ekstrakurikuler)
    {
        $pembina = Pembina::all();
        return view('ekstrakurikuler.edit', compact('ekstrakurikuler', 'pembina'));
    }

    public function update(Request $request, Ekstrakurikuler $ekstrakurikuler)
    {
        $request->validate([
            'nip_pembina' => 'required|exists:pembina,nip_pembina',
            'nama_ekstrakurikuler' => 'required',
            'nama' => 'required',
        ]);

        $ekstrakurikuler->update($request->all());

        return redirect()->route('ekstrakurikuler.index')
            ->with('success', 'Data ekstrakurikuler berhasil diperbaharui.');
    }

    public function destroy(Ekstrakurikuler $ekstrakurikuler)
    {
        $ekstrakurikuler->delete();

        return redirect()->route('ekstrakurikuler.index')
            ->with('success', 'Data ekstrakurikuler berhasil dihapus.');
    }
}
