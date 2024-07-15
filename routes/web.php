<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ChatController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KetuaController;
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
    Route::get('/pembina', [PembinaController::class, 'index'])->name('pembina.index')->middleware('permission:pembina.index');
    Route::get('/pembina/createuser', [PembinaController::class, 'createuser'])->name('pembina.createuser')->middleware('permission:pembina.createuser');
    Route::post('/pembina/store', [PembinaController::class, 'store'])->name('pembina.store')->middleware('permission:pembina.store');
    Route::get('/pembina/createuser', [PembinaController::class, 'createUser'])->name('pembina.createuser')->middleware('permission:pembina.createuser');
    Route::post('/pembina/storeuser', [PembinaController::class, 'storeUser'])->name('pembina.storeuser')->middleware('permission:pembina.storeuser');
    Route::get('/pembina/{id}/edit', [PembinaController::class, 'edit'])->name('pembina.edit')->middleware('permission:pembina.edit');
    Route::put('/pembina/{id}/update', [PembinaController::class, 'update'])->name('pembina.update')->middleware('permission:pembina.update');
    Route::delete('/pembina/destroy/{id}', [PembinaController::class, 'destroy'])->name('pembina.destroy')->middleware('permission:pembina.destroy');

    //Menu Ketua
    Route::get('/ketua', [KetuaController::class, 'index'])->name('ketua.index')->middleware('permission:ketua.index');
    Route::get('/ketua/createuser', [KetuaController::class, 'createuser'])->name('ketua.createuser')->middleware('permission:ketua.createuser');
    Route::post('/ketua/store', [KetuaController::class, 'store'])->name('ketua.store')->middleware('permission:ketua.store');
    Route::get('/ketua/{id}/edit', [KetuaController::class, 'edit'])->name('ketua.edit')->middleware('permission:ketua.edit');
    Route::put('/ketua/{id}/update', [KetuaController::class, 'update'])->name('ketua.update')->middleware('permission:ketua.update');
    Route::delete('/ketua/destroy/{id}', [KetuaController::class, 'destroy'])->name('ketua.destroy')->middleware('permission:ketua.destroy');


    // Menu Ekstrakurikuler
    Route::get('/ekstrakurikuler', [EkstrakurikulerController::class, 'index'])->name('ekstrakurikuler.index')->middleware('permission:ekstrakurikuler.index');
    Route::get('/ekstrakurikuler/create', [EkstrakurikulerController::class, 'create'])->name('ekstrakurikuler.create')->middleware('permission:ekstrakurikuler.create');
    Route::post('/ekstrakurikuler/store', [EkstrakurikulerController::class, 'store'])->name('ekstrakurikuler.store')->middleware('permission:ekstrakurikuler.store');
    Route::get('/ekstrakurikuler/{id}/edit', [EkstrakurikulerController::class, 'edit'])->name('ekstrakurikuler.edit')->middleware('permission:ekstrakurikuler.edit');
    Route::put('/ekstrakurikuler/{id}/update', [EkstrakurikulerController::class, 'update'])->name('ekstrakurikuler.update')->middleware('permission:ekstrakurikuler.update');
    Route::delete('/ekstrakurikuler/destroy/{id}', [EkstrakurikulerController::class, 'destroy'])->name('ekstrakurikuler.destroy')->middleware('permission:ekstrakurikuler.destroy');
});


require __DIR__ . '/auth.php';
