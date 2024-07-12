<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ChatController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\PembinaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KehadiranController;
use App\Http\Controllers\PrestasiSiswaController;
use App\Http\Controllers\EkstrakurikulerController;
use App\Http\Controllers\ProgramKegiatanController;
use App\Http\Controllers\JadwalEkstrakurikulerController;
use App\Http\Controllers\PrestasiEkstrakurikulerController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('admin-page', function () {
    return 'Halaman untuk Admin';
})->middleware('role:admin')->name('admin.page');

Route::get('user-page', function () {
    return 'Halaman untuk User';
})->middleware('role:user')->name('user.page');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Routes for admin
Route::group(['middleware' => ['role:admin']], function () {
    Route::get('/manage/users', [UserController::class, 'index'])->name('manage.users');
    Route::resource('users', UserController::class);

    Route::get('/manage/siswa', [SiswaController::class, 'index'])->name('manage.siswa');
    Route::resource('siswa', SiswaController::class);

    Route::get('/manage/pembina', [PembinaController::class, 'index'])->name('manage.pembina');
    Route::resource('pembina', PembinaController::class);

    Route::get('/manage/ekstrakurikuler', [EkstrakurikulerController::class, 'index'])->name('manage.ekstrakurikuler');
    Route::resource('ekstrakurikuler', EkstrakurikulerController::class);

    // Route::get('/pembina', [PembinaController::class, 'index'])->name('manage.pembina');
    // Route::get('/pembina/create', [PembinaController::class, 'create'])->name('pembina.create');
    // Route::post('/pembina', [PembinaController::class, 'store'])->name('pembina.store');
    // Route::get('/pembina/{pembina}/edit', [PembinaController::class, 'edit'])->name('pembina.edit');
    // Route::put('/pembina/{pembina}', [PembinaController::class, 'update'])->name('pembina.update');
    // Route::delete('/pembina/{pembina}', [PembinaController::class, 'destroy'])->name('pembina.destroy');

    // Route::get('/manage/ekstrakurikuler', 'AdminController@manageEkstrakurikuler')->name('manage.ekstrakurikuler');
    // Route::get('/manage/program-kegiatan', 'AdminController@manageProgramKegiatan')->name('manage.program.kegiatan');
    // Route::get('/manage/kehadiran', 'AdminController@manageKehadiran')->name('manage.kehadiran');
    // Route::get('/manage/jadwal-ekstrakurikuler', 'AdminController@manageJadwalEkstrakurikuler')->name('manage.jadwal.ekstrakurikuler');
    // Route::get('/manage/prestasi-ekstrakurikuler', 'AdminController@managePrestasiEkstrakurikuler')->name('manage.prestasi.ekstrakurikuler');
    // Route::get('/manage/prestasi-peserta', 'AdminController@managePrestasiPeserta')->name('manage.prestasi.peserta');
    // Route::get('/chat-with-pembina', 'AdminController@chatWithPembina')->name('chat.with.pembina');
});

// Routes for pembina
// Route::group(['middleware' => ['role:pembina']], function () {
//     Route::get('/review/program-kegiatan', 'PembinaController@reviewProgramKegiatan')->name('review.program.kegiatan');
//     Route::get('/review/kehadiran', 'PembinaController@reviewKehadiran')->name('review.kehadiran');
//     Route::get('/view/jadwal-ekstrakurikuler', 'PembinaController@viewJadwalEkstrakurikuler')->name('view.jadwal.ekstrakurikuler');
//     Route::get('/view/prestasi-ekstrakurikuler', 'PembinaController@viewPrestasiEkstrakurikuler')->name('view.prestasi.ekstrakurikuler');
//     Route::get('/review/prestasi-peserta', 'PembinaController@reviewPrestasiPeserta')->name('review.prestasi.peserta');
//     Route::get('/chat-with-siswa', 'PembinaController@chatWithSiswa')->name('chat.with.siswa');
//     Route::get('/review/pertemuan', 'PembinaController@reviewPertemuan')->name('review.pertemuan');
// });

// Routes for siswa
// Route::group(['middleware' => ['role:siswa']], function () {
//     Route::get('/view/ekstrakurikuler', 'SiswaController@viewEkstrakurikuler')->name('view.ekstrakurikuler');
//     Route::get('/add/view/program-kegiatan', 'SiswaController@addViewProgramKegiatan')->name('add.view.program.kegiatan');
//     Route::get('/add/view/berkas-kehadiran', 'SiswaController@addViewBerkasKehadiran')->name('add.view.berkas.kehadiran');
//     Route::get('/view/jadwal-ekstrakurikuler', 'SiswaController@viewJadwalEkstrakurikuler')->name('view.jadwal.ekstrakurikuler');
//     Route::get('/add/view/prestasi-ekstrakurikuler', 'SiswaController@addViewPrestasiEkstrakurikuler')->name('add.view.prestasi.ekstrakurikuler');
//     Route::get('/add/view/prestasi/siswa', 'SiswaController@addViewPrestasiSiswa')->name('add.view.prestasi.siswa');
//     Route::get('/request/pertemuan', 'SiswaController@requestPertemuan')->name('request.pertemuan');
//     Route::get('/chat-with-pembina', 'SiswaController@chatWithPembina')->name('chat.with.pembina');
// });

require __DIR__ . '/auth.php';
