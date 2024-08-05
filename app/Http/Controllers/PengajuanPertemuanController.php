<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengajuanPertemuan;
use App\Models\Ketua;
use App\Models\Pembina;
use Illuminate\Support\Facades\Auth;

class PengajuanPertemuanController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->hasRole('Pembina')) {
            $pembina = $user->pembina;

            if (!$pembina) {
                abort(403, 'Pembina data not found.');
            }

            $pertemuan = PengajuanPertemuan::with('ketua')
                ->where('pembina_id', $pembina->id_pembina)
                ->get();
        } else {
            $ketuaId = $user->ketua->id_ketua;
            $pertemuan = PengajuanPertemuan::with('ketua')
                ->where('ketua_id', $ketuaId)
                ->get();
        }

        return view('pertemuan.index', compact('pertemuan'));
    }

    public function verifikasi(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:disetujui,ditolak',
            'keterangan' => 'nullable|string',
        ]);

        $pengajuanPertemuan = PengajuanPertemuan::findOrFail($id);
        $pengajuanPertemuan->status = $request->status;
        $pengajuanPertemuan->keterangan = $request->keterangan;
        $pengajuanPertemuan->verifikasi_id = auth()->user()->pembina->id_pembina ?? null;
        $pengajuanPertemuan->waktu_verifikasi = now();
        $pengajuanPertemuan->save();

        return redirect()->route('pertemuan.index')->with('success', 'Pertemuan berhasil diverifikasi.');
    }

    public function create()
    {
        if (!Auth::user()->ketua) {
            return redirect()->route('pertemuan.index')->withErrors('Pengguna yang login tidak memiliki data ketua yang valid.');
        }

        $ekstrakurikuler_id = Auth::user()->ketua->ekstrakurikuler_id;
        $pembina = Pembina::where('ekstrakurikuler_id', $ekstrakurikuler_id)->get();

        if ($pembina->isEmpty()) {
            return redirect()->route('pertemuan.index')->withErrors('Tidak ada pembina yang ditemukan untuk ekstrakurikuler ini.');
        }

        return view('pertemuan.create', compact('pembina'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pembina_id' => 'required|exists:pembina,id_pembina',
            'hari' => 'required|string',
            'tanggal' => 'required|date|after_or_equal:today',
            'waktu' => [
                'required',
                'date_format:H:i',
                function ($attribute, $value, $fail) use ($request) {
                    $tanggal = $request->input('tanggal');
                    $tanggalWaktu = $tanggal . ' ' . $value;
                    $currentDateTime = now()->format('Y-m-d H:i');

                    if ($tanggalWaktu < $currentDateTime) {
                        $fail('Waktu harus lebih besar dari waktu saat ini.');
                    }
                },
            ],
        ]);

        if (!Auth::user()->ketua) {
            return redirect()->route('pertemuan.index')->withErrors('Pengguna yang login tidak memiliki data ketua yang valid.');
        }

        $ketua_id = Auth::user()->ketua->id_ketua;

        PengajuanPertemuan::create([
            'ketua_id' => $ketua_id,
            'pembina_id' => $request->pembina_id,
            'hari' => $request->hari,
            'tanggal' => $request->tanggal,
            'waktu' => $request->waktu,
            'status' => 'pending',
        ]);

        return redirect()->route('pertemuan.index')->with('success', 'Pertemuan berhasil diajukan.');
    }

    public function edit($id)
    {
        $pertemuan = PengajuanPertemuan::findOrFail($id);
        return view('pertemuan.edit', compact('pertemuan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'hari' => 'required|string',
            'tanggal' => 'required|date|after_or_equal:today',
            'waktu' => [
                'required',
                'date_format:H:i',
                function ($attribute, $value, $fail) use ($request) {
                    $tanggal = $request->input('tanggal');
                    $tanggalWaktu = $tanggal . ' ' . $value;
                    $currentDateTime = now()->format('Y-m-d H:i');

                    if ($tanggalWaktu < $currentDateTime) {
                        $fail('Waktu harus lebih besar dari waktu saat ini.');
                    }
                },
            ],
        ]);

        $pertemuan = PengajuanPertemuan::findOrFail($id);

        if (!Auth::user()->ketua) {
            return redirect()->route('pertemuan.index')->withErrors('Pengguna yang login tidak memiliki data ketua yang valid.');
        }

        $pertemuan->hari = $request->hari;
        $pertemuan->tanggal = $request->tanggal;
        $pertemuan->waktu = $request->waktu;
        $pertemuan->save();

        return redirect()->route('pertemuan.index')->with('success', 'Pertemuan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pertemuan = PengajuanPertemuan::findOrFail($id);
        $pertemuan->delete();
        return redirect()->route('pertemuan.index')->with('success', 'Pertemuan berhasil dihapus.');
    }

    public function show($id)
    {
        $pertemuan = PengajuanPertemuan::with('ketua', 'pembina')->findOrFail($id);
        return response()->json($pertemuan);
    }
}
