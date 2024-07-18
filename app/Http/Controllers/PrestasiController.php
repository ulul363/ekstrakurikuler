<?php

namespace App\Http\Controllers;

use App\Models\Prestasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PrestasiController extends Controller
{
    public function index()
    {
        $ketuaId = Auth::user()->ketua->id_ketua;
        $prestasi = Prestasi::with('ekstrakurikuler', 'ketua', 'pembina')->where('ketua_id', $ketuaId)->get();
        return view('prestasi.index', compact('prestasi'));
    }

    public function create()
    {
        return view('prestasi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'prestasi' => 'required|string|max:50',
            'nama_siswa.*' => 'required|string|max:50',
            'tahun_ajaran' => 'required|integer',
            'berkas' => 'required|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $fileName = time() . '_' . $request->file('berkas')->getClientOriginalName();
        $filePath = $request->file('berkas')->storeAs('uploads/prestasi', $fileName, 'public');

        Prestasi::create([
            'ekstrakurikuler_id' => Auth::user()->ketua->ekstrakurikuler_id,
            'ketua_id' => Auth::user()->ketua->id_ketua,
            'nama_siswa' => $request->nama_siswa,
            'tahun_ajaran' => $request->tahun_ajaran,
            'berkas' => $filePath,
            'status' => 'pending',
        ]);

        return redirect()->route('prestasi.index')->with('success', 'Prestasi berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $prestasi = Prestasi::findOrFail($id);
        return view('prestasi.edit', compact('prestasi'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'prestasi' => 'required|string|max:50',
            'nama_siswa.*' => 'required|string|max:50',
            'tahun_ajaran' => 'required|integer',
            'berkas' => 'nullable|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $prestasi = Prestasi::findOrFail($id);
        $prestasi->nama_siswa = $request->nama_siswa;
        $prestasi->tahun_ajaran = $request->tahun_ajaran;

        if ($request->hasFile('berkas')) {
            if (Storage::disk('public')->exists($prestasi->berkas)) {
                Storage::disk('public')->delete($prestasi->berkas);
            }

            $fileName = time() . '_' . $request->file('berkas')->getClientOriginalName();
            $filePath = $request->file('berkas')->storeAs('uploads/prestasi', $fileName, 'public');
            $prestasi->berkas = $filePath;
        }

        $prestasi->save();

        return redirect()->route('prestasi.index')->with('success', 'Prestasi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $prestasi = Prestasi::findOrFail($id);
        if (Storage::disk('public')->exists($prestasi->berkas)) {
            Storage::disk('public')->delete($prestasi->berkas);
        }
        $prestasi->delete();

        return redirect()->route('prestasi.index')->with('success', 'Prestasi berhasil dihapus.');
    }
}