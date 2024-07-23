<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ChatController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KetuaController;
use App\Http\Controllers\PembinaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\KehadiranController;
use App\Http\Controllers\EkstrakurikulerController;
use App\Http\Controllers\ProgramKegiatanController;
use App\Http\Controllers\JadwalEkstrakurikulerController;
use App\Http\Controllers\PrestasiEkstrakurikulerController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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
// Route::group(['middleware' => ['role:admin']], function () {
//     // Role Managemen
//     Route::get('/manage/roles', [RoleController::class, 'index'])->name('manage.roles');
//     Route::get('/manage/roles/create', [RoleController::class, 'create'])->name('roles.create');
//     Route::post('/manage/roles', [RoleController::class, 'store'])->name('roles.store');
//     Route::get('/manage/roles/{id}/edit', [RoleController::class, 'edit'])->name('roles.edit');
//     Route::put('/manage/roles/{id}', [RoleController::class, 'update'])->name('roles.update');
//     Route::delete('/manage/roles/{id}', [RoleController::class, 'destroy'])->name('roles.destroy');

//     // Route to get all routes and update permissions
//     Route::get('/manage/roles/update-permissions', [RoleController::class, 'getRoutesAllJson'])->name('roles.update_permissions');
//     Route::get('/manage/roles/refresh-permissions', [RoleController::class, 'getRefreshAndDeleteJson'])->name('roles.refresh_permissions');


//     Route::get('/manage/users', [UserController::class, 'index'])->name('manage.users');
//     Route::resource('users', UserController::class);

//     Route::get('/manage/siswa', [SiswaController::class, 'index'])->name('manage.siswa');
//     Route::resource('siswa', SiswaController::class);

//     Route::get('/manage/pembina', [PembinaController::class, 'index'])->name('manage.pembina');
//     Route::resource('pembina', PembinaController::class);

//     Route::get('/manage/ekstrakurikuler', [EkstrakurikulerController::class, 'index'])->name('manage.ekstrakurikuler');
//     Route::resource('ekstrakurikuler', EkstrakurikulerController::class);

//     Route::get('/pembina', [PembinaController::class, 'index'])->name('manage.pembina');
//     Route::get('/pembina/create', [PembinaController::class, 'create'])->name('pembina.create');
//     Route::post('/pembina', [PembinaController::class, 'store'])->name('pembina.store');
//     Route::get('/pembina/{pembina}/edit', [PembinaController::class, 'edit'])->name('pembina.edit');
//     Route::put('/pembina/{pembina}', [PembinaController::class, 'update'])->name('pembina.update');
//     Route::delete('/pembina/{pembina}', [PembinaController::class, 'destroy'])->name('pembina.destroy');

//     Route::get('/manage/ekstrakurikuler', 'AdminController@manageEkstrakurikuler')->name('manage.ekstrakurikuler');
//     Route::get('/manage/program-kegiatan', 'AdminController@manageProgramKegiatan')->name('manage.program.kegiatan');
//     Route::get('/manage/kehadiran', 'AdminController@manageKehadiran')->name('manage.kehadiran');
//     Route::get('/manage/jadwal-ekstrakurikuler', 'AdminController@manageJadwalEkstrakurikuler')->name('manage.jadwal.ekstrakurikuler');
//     Route::get('/manage/prestasi-ekstrakurikuler', 'AdminController@managePrestasiEkstrakurikuler')->name('manage.prestasi.ekstrakurikuler');
//     Route::get('/manage/prestasi-peserta', 'AdminController@managePrestasiPeserta')->name('manage.prestasi.peserta');
//     Route::get('/chat-with-pembina', 'AdminController@chatWithPembina')->name('chat.with.pembina');
// });

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



Route::middleware(['auth', 'verified'])->group(function () {
    // Menu Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // User Access Management
    Route::get('/user', [UserController::class, 'index'])->name('user.index')->middleware('permission:user.index');
    Route::get('/user/create', [UserController::class, 'create'])->name('user.create')->middleware('permission:user.create');
    Route::post('/user/store', [UserController::class, 'store'])->name('user.store')->middleware('permission:user.store');
    Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit')->middleware('permission:user.edit');
    Route::patch('/user/{id}/update', [UserController::class, 'update'])->name('user.update')->middleware('permission:user.update');
    Route::delete('/user/destroy{id}', [UserController::class, 'destroy'])->name('user.destroy')->middleware('permission:user.destroy');

    // Role Access Management
    Route::get('/role', [RoleController::class, 'index'])->name('role.index')->middleware('permission:role.index');
    Route::get('/role/create', [RoleController::class, 'create'])->name('role.create')->middleware('permission:role.create');
    Route::post('/role/store', [RoleController::class, 'store'])->name('role.store')->middleware('permission:role.store');
    Route::get('/role/{id}/edit', [RoleController::class, 'edit'])->name('role.edit')->middleware('permission:role.edit');
    Route::put('/roles/{id}/update', [RoleController::class, 'update'])->name('role.update')->middleware('permission:role.update');
    Route::delete('/role/destroy{id}', [RoleController::class, 'destroy'])->name('role.destroy')->middleware('permission:role.destroy');
    Route::get('/role/getRoutesAll', [RoleController::class, 'getRoutesAllJson'])->name('role.getRoutesAllJson')->middleware('permission:role.getRoutesAllJson');
    Route::get('/role/getRoutesRefreshDelete', [RoleController::class, 'getRefreshAndDeleteJson'])->name('role.getRefreshAndDeleteJson')->middleware('permission:role.getRefreshAndDeleteJson');

    //Menu Pembina
    // Route::get('/pembina', [PembinaController::class, 'index'])->name('pembina.index')->middleware('permission:pembina.index');
    // Route::get('/pembina/create', [PembinaController::class, 'create'])->name('pembina.create')->middleware('permission:pembina.create');
    // Route::post('/pembina/store', [PembinaController::class, 'store'])->name('pembina.store')->middleware('permission:pembina.store');
    // Route::get('/pembina/{id}/edit', [PembinaController::class, 'edit'])->name('pembina.edit')->middleware('permission:pembina.edit');
    // Route::put('/pembina/{id}/update', [PembinaController::class, 'update'])->name('pembina.update')->middleware('permission:pembina.update');
    // Route::delete('/pembina/destroy/{id}', [PembinaController::class, 'destroy'])->name('pembina.destroy')->middleware('permission:pembina.destroy');


    // Menu Pembina
    Route::get('/pembina', [PembinaController::class, 'index'])->name('pembina.index')->middleware('permission:pembina.index');
    Route::get('/pembina/create', [PembinaController::class, 'create'])->name('pembina.create')->middleware('permission:pembina.create');
    Route::post('/pembina/store', [PembinaController::class, 'store'])->name('pembina.store')->middleware('permission:pembina.store');
    Route::get('/pembina/{id}/edit', [PembinaController::class, 'edit'])->name('pembina.edit')->middleware('permission:pembina.edit');
    Route::put('/pembina/{id}/update', [PembinaController::class, 'update'])->name('pembina.update')->middleware('permission:pembina.update');
    Route::delete('/pembina/{id}', [PembinaController::class, 'destroy'])->name('pembina.destroy')->middleware('permission:pembina.destroy');
    Route::get('/pembina/createuser', [PembinaController::class, 'createUser'])->name('pembina.createuser')->middleware('permission:pembina.createuser');
    Route::post('/pembina/storeuser', [PembinaController::class, 'storeUser'])->name('pembina.storeuser')->middleware('permission:pembina.storeuser');
    Route::put('/pembina/{id}/updateUser', [PembinaController::class, 'updateUser'])->name('pembina.updateUser')->middleware('permission:pembina.updateUser');


    //Menu Ketua
    Route::get('/ketua', [KetuaController::class, 'index'])->name('ketua.index')->middleware('permission:ketua.index');
    Route::get('/ketua/create', [KetuaController::class, 'create'])->name('ketua.create')->middleware('permission:ketua.create');
    Route::post('/ketua/store', [KetuaController::class, 'store'])->name('ketua.store')->middleware('permission:ketua.store');
    Route::get('/ketua/{id}/edit', [KetuaController::class, 'edit'])->name('ketua.edit')->middleware('permission:ketua.edit');
    Route::put('/ketua/{id}/update', [KetuaController::class, 'update'])->name('ketua.update')->middleware('permission:ketua.update');
    Route::delete('/ketua/{id}', [KetuaController::class, 'destroy'])->name('ketua.destroy')->middleware('permission:ketua.destroy');
    Route::get('/ketua/createuser', [KetuaController::class, 'createUser'])->name('ketua.createuser')->middleware('permission:ketua.createuser');
    Route::post('/ketua/storeuser', [KetuaController::class, 'storeUser'])->name('ketua.storeuser')->middleware('permission:ketua.storeuser');
    Route::put('/ketua/{id}/updateUser', [KetuaController::class, 'updateUser'])->name('ketua.updateUser')->middleware('permission:ketua.updateUser');


    // Menu Ekstrakurikuler
    Route::get('/ekstrakurikuler', [EkstrakurikulerController::class, 'index'])->name('ekstrakurikuler.index')->middleware('permission:ekstrakurikuler.index');
    Route::get('/ekstrakurikuler/create', [EkstrakurikulerController::class, 'create'])->name('ekstrakurikuler.create')->middleware('permission:ekstrakurikuler.create');
    Route::post('/ekstrakurikuler/store', [EkstrakurikulerController::class, 'store'])->name('ekstrakurikuler.store')->middleware('permission:ekstrakurikuler.store');
    Route::get('/ekstrakurikuler/{id}/edit', [EkstrakurikulerController::class, 'edit'])->name('ekstrakurikuler.edit')->middleware('permission:ekstrakurikuler.edit');
    Route::put('/ekstrakurikuler/{id}/update', [EkstrakurikulerController::class, 'update'])->name('ekstrakurikuler.update')->middleware('permission:ekstrakurikuler.update');
    Route::delete('/ekstrakurikuler/destroy/{id}', [EkstrakurikulerController::class, 'destroy'])->name('ekstrakurikuler.destroy')->middleware('permission:ekstrakurikuler.destroy');

    // Meny Jadwal Ekstrakurikuler
    Route::get('/jadwal_ekstrakurikuler', [JadwalEkstrakurikulerController::class, 'index'])->name('jadwal_ekstrakurikuler.index')->middleware('permission:jadwal_ekstrakurikuler.index');
    Route::get('/jadwal_ekstrakurikuler/create', [JadwalEkstrakurikulerController::class, 'create'])->name('jadwal_ekstrakurikuler.create')->middleware('permission:jadwal_ekstrakurikuler.create');
    Route::post('/jadwal_ekstrakurikuler/store', [JadwalEkstrakurikulerController::class, 'store'])->name('jadwal_ekstrakurikuler.store')->middleware('permission:jadwal_ekstrakurikuler.store');
    Route::get('/jadwal_ekstrakurikuler/{id}/edit', [JadwalEkstrakurikulerController::class, 'edit'])->name('jadwal_ekstrakurikuler.edit')->middleware('permission:jadwal_ekstrakurikuler.edit');
    Route::put('/jadwal_ekstrakurikuler/{id}/update', [JadwalEkstrakurikulerController::class, 'update'])->name('jadwal_ekstrakurikuler.update')->middleware('permission:jadwal_ekstrakurikuler.update');
    Route::delete('/jadwal_ekstrakurikuler/destroy/{id}', [JadwalEkstrakurikulerController::class, 'destroy'])->name('jadwal_ekstrakurikuler.destroy')->middleware('permission:jadwal_ekstrakurikuler.destroy');

    // Menu Program Kegiatan
    Route::get('/program_kegiatan', [ProgramKegiatanController::class, 'index'])->name('program_kegiatan.index')->middleware('permission:program_kegiatan.index');
    Route::get('/program_kegiatan/create', [ProgramKegiatanController::class, 'create'])->name('program_kegiatan.create')->middleware('permission:program_kegiatan.create');
    Route::post('/program_kegiatan/store', [ProgramKegiatanController::class, 'store'])->name('program_kegiatan.store')->middleware('permission:program_kegiatan.store');
    Route::get('/program_kegiatan/{id}/edit', [ProgramKegiatanController::class, 'edit'])->name('program_kegiatan.edit')->middleware('permission:program_kegiatan.edit');
    Route::put('/program_kegiatan/{id}/update', [ProgramKegiatanController::class, 'update'])->name('program_kegiatan.update')->middleware('permission:program_kegiatan.update');
    Route::delete('/program_kegiatan/destroy/{id}', [ProgramKegiatanController::class, 'destroy'])->name('program_kegiatan.destroy')->middleware('permission:program_kegiatan.destroy');
    Route::get('/program_kegiatan/{id}', [ProgramKegiatanController::class, 'show'])->name('program_kegiatan.show')->middleware('permission:program_kegiatan.show');
    Route::post('program_kegiatan/verifikasi/{id}', [ProgramKegiatanController::class, 'verifikasi'])->name('program_kegiatan.verifikasi')->middleware('permission:program_kegiatan.verifikasi');


    // Menu Kehadiran
    Route::get('/kehadiran', [KehadiranController::class, 'index'])->name('kehadiran.index')->middleware('permission:kehadiran.index');
    Route::get('/kehadiran/create', [KehadiranController::class, 'create'])->name('kehadiran.create')->middleware('permission:kehadiran.create');
    Route::post('/kehadiran/store', [KehadiranController::class, 'store'])->name('kehadiran.store')->middleware('permission:kehadiran.store');
    Route::get('/kehadiran/{id}/edit', [KehadiranController::class, 'edit'])->name('kehadiran.edit')->middleware('permission:kehadiran.edit');
    Route::put('/kehadiran/{id}/update', [KehadiranController::class, 'update'])->name('kehadiran.update')->middleware('permission:kehadiran.update');
    Route::delete('/kehadiran/destroy/{id}', [KehadiranController::class, 'destroy'])->name('kehadiran.destroy')->middleware('permission:kehadiran.destroy');
    Route::get('/kehadiran/{id}', [KehadiranController::class, 'show'])->name('kehadiran.show')->middleware('permission:kehadiran.show');
    Route::post('kehadiran/verifikasi/{id}', [KehadiranController::class, 'verifikasi'])->name('kehadiran.verifikasi')->middleware('permission:kehadiran.verifikasi');

    // Menu Prestasi
    Route::get('/prestasi', [PrestasiController::class, 'index'])->name('prestasi.index')->middleware('permission:prestasi.index');
    Route::get('/prestasi/create', [PrestasiController::class, 'create'])->name('prestasi.create')->middleware('permission:prestasi.create');
    Route::post('/prestasi/store', [PrestasiController::class, 'store'])->name('prestasi.store')->middleware('permission:prestasi.store');
    Route::get('/prestasi/{id}/edit', [PrestasiController::class, 'edit'])->name('prestasi.edit')->middleware('permission:prestasi.edit');
    Route::put('/prestasi/{id}/update', [PrestasiController::class, 'update'])->name('prestasi.update')->middleware('permission:prestasi.update');
    Route::delete('/prestasi/{id}/destroy', [PrestasiController::class, 'destroy'])->name('prestasi.destroy')->middleware('permission:prestasi.destroy');
    Route::get('/prestasi/{id}', [PrestasiController::class, 'show'])->name('prestasi.show')->middleware('permission:prestasi.show');
    Route::post('prestasi/verifikasi/{id}', [PrestasiController::class, 'verifikasi'])->name('prestasi.verifikasi')->middleware('permission:prestasi.verifikasi');
});


require __DIR__ . '/auth.php';
