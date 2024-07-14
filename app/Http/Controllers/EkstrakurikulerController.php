<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ekstrakurikuler;

class EkstrakurikulerController extends Controller
{
    public function index()
    {
        $ekstrakurikulers = Ekstrakurikuler::all();
        return view('ekstrakurikuler.index', compact('ekstrakurikulers'));
    }

    public function create()
    {
        return view('ekstrakurikuler.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:20',
        ]);

        Ekstrakurikuler::create([
            'nama' => $request->nama,
        ]);

        return redirect()->route('ekstrakurikuler.index')->with('success', 'Ekstrakurikuler created successfully.');
    }

    public function edit($id)
    {
        $ekstrakurikuler = Ekstrakurikuler::findOrFail($id);
        return view('ekstrakurikuler.edit', compact('ekstrakurikuler'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:20',
        ]);

        $ekstrakurikuler = Ekstrakurikuler::findOrFail($id);
        $ekstrakurikuler->update($request->all());

        return redirect()->route('ekstrakurikuler.index')->with('success', 'Ekstrakurikuler updated successfully.');
    }

    public function destroy($id)
    {
        $ekstrakurikuler = Ekstrakurikuler::findOrFail($id);
        $ekstrakurikuler->delete();

        return redirect()->route('ekstrakurikuler.index')->with('success', 'Ekstrakurikuler deleted successfully.');
    }
}
