<?php

namespace App\Http\Controllers;

use App\Models\Pembina;
use Illuminate\Http\Request;
use App\Models\JadwalPembina;
use Illuminate\Support\Facades\Auth;

class JadwalPembinaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pembina = Auth::user();
        $idpembina = Pembina::where('nama', $pembina->name)->first();
        $jadwalPembina = JadwalPembina::where('pembina_id', $idpembina->id_pembina)->get();
        // dd($jadwal);
        return view('jadwalpembina.index', compact('jadwalPembina'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jadwalpembina.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'hari' => 'required|string',
            'waktu_mulai' => 'required|date_format:H:i',
            'waktu_selesai' => 'required|date_format:H:i',
            'status' => 'required|in:tersedia,tidak tersedia', // Menambahkan validasi untuk enum status
        ]);

        // Mendapatkan ID Pembina dari Auth
        $pembina = Auth::user();
        $idpembina = Pembina::where('nama', $pembina->name)->first();

        // Membuat record Jadwal Pembina
        JadwalPembina::create([
            'pembina_id' => $idpembina->id_pembina,
            'hari' => $request->hari,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
            'status' => $request->status,
        ]);

        return redirect()->route('jadwal.pembina.index'); // Ganti 'route_name' dengan nama route yang sesuai
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $jadwal = JadwalPembina::findOrFail($id); // Mencari jadwal berdasarkan ID
        return view('jadwalpembina.edit', compact('jadwal'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'hari' => 'required|string',
            'waktu_mulai' => 'required|date_format:H:i',
            'waktu_selesai' => 'required|date_format:H:i',
            'status' => 'required|in:tersedia,tidak tersedia',
        ]);

        $jadwal = JadwalPembina::findOrFail($id); // Cari jadwal berdasarkan ID

        // Update data jadwal pembina
        $jadwal->hari = $request->hari;
        $jadwal->waktu_mulai = $request->waktu_mulai;
        $jadwal->waktu_selesai = $request->waktu_selesai;
        $jadwal->status = $request->status;
        $jadwal->save();

        return redirect()->route('jadwal.pembina.index')
            ->with('success', 'Jadwal Pembina berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $jadwal = JadwalPembina::findOrFail($id); // Mencari jadwal berdasarkan ID

        // Melakukan penghapusan jadwal
        $jadwal->delete();

        return redirect()->route('jadwal.pembina.index')
            ->with('success', 'Jadwal Pembina berhasil dihapus');
    }

    public function buatjadwal()
    {
        $buatjadwal = JadwalPembina::all();

        return view('ketua.jadwal', compact('buatjadwal'));
    }

    public function ajukanpertemuan($id)
{
    // Proses ajukan pertemuan sesuai dengan $id jadwal yang dipilih
    // Contoh implementasi sederhana
    $jadwal = JadwalPembina::findOrFail($id);

    // Lakukan operasi ajukan pertemuan, misalnya:
    // $jadwal->ajukanPertemuan(); // Implementasi sesuai kebutuhan

    return redirect()->route('jadwal.pembina.index')
        ->with('success', 'Pertemuan berhasil diajukan untuk jadwal ini');
}

}
