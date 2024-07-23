<?php

namespace App\Http\Controllers;

use App\Models\Ketua;
use App\Models\Ekstrakurikuler;
use App\Models\Prestasi;
use App\Models\Kehadiran;
use App\Models\ProgramKegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->hasRole('Pembina')) {
            $pembina = $user->pembina;

            if (!$pembina) {
                abort(403, 'Pembina data not found.');
            }

            $ekstrakurikulerId = $pembina->ekstrakurikuler_id;
            $prestasi = Prestasi::with('ekstrakurikuler', 'ketua')
                ->whereHas('ekstrakurikuler', function ($query) use ($ekstrakurikulerId) {
                    $query->where('id_ekstrakurikuler', $ekstrakurikulerId);
                })
                ->get();
            $ekstrakurikulerId = $pembina->ekstrakurikuler_id;
            $kehadiran = Kehadiran::with('ekstrakurikuler', 'ketua')
                ->whereHas('ekstrakurikuler', function ($query) use ($ekstrakurikulerId) {
                    $query->where('id_ekstrakurikuler', $ekstrakurikulerId);
                })
                ->get();
            $programKegiatan = ProgramKegiatan::with('ekstrakurikuler', 'ketua')
            ->whereHas('ekstrakurikuler', function ($query) use ($ekstrakurikulerId) {
                $query->where('id_ekstrakurikuler', $ekstrakurikulerId);
            })
            ->get();
        } else {
            $ketuaId = $user->ketua->id_ketua;
            $prestasi = Prestasi::with('ekstrakurikuler', 'ketua')->where('ketua_id', $ketuaId)->get();
            $kehadiran = Kehadiran::with('ekstrakurikuler', 'ketua')->where('ketua_id', $ketuaId)->get();
            $programKegiatan = ProgramKegiatan::with('ekstrakurikuler', 'ketua')->where('ketua_id', $ketuaId)->get();
        }
        $ekstrakurikulers = Ekstrakurikuler::all();
        return view('dashboard', compact('ekstrakurikulers', 'prestasi', 'kehadiran', 'programKegiatan'));
    }

}