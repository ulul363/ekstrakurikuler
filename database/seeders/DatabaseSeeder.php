<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Ketua;
use App\Models\Pembina;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Step 1: Create Permissions
        $this->createPermissions();

        // Step 2: Create Admin Role
        $this->createAdminRole();

        // Step 3: Create Ketua and Pembina Roles
        $this->createKetuaAndPembinaRoles();

        // Step 4: Insert Ekstrakurikuler
        $this->insertEkstrakurikuler();

        // Step 5: Insert Jadwal Ekstrakurikuler
        $this->insertJadwalEkstrakurikuler();

        // Step 6: Create Ketua Users
        $this->createKetuaUsers();

        // Step 7: Create Pembina Users
        $this->createPembinaUsers();
    }

    private function createPermissions()
    {
        $permissions = [
            // Admin Permissions
            'user.index',
            'user.create',
            'user.store',
            'user.edit',
            'user.update',
            'user.destroy',
            'role.index',
            'role.create',
            'role.store',
            'role.edit',
            'role.update',
            'role.destroy',
            'role.getRoutesAllJson',
            'role.getRefreshAndDeleteJson',
            'dashboard',
            'pembina.index',
            'pembina.create',
            'pembina.store',
            'pembina.edit',
            'pembina.update',
            'pembina.destroy',
            'pembina.createuser',
            'pembina.storeuser',
            'pembina.updateUser',
            'ketua.index',
            'ketua.create',
            'ketua.store',
            'ketua.edit',
            'ketua.update',
            'ketua.destroy',
            'ketua.createuser',
            'ketua.storeuser',
            'ketua.updateUser',
            'ekstrakurikuler.index',
            'ekstrakurikuler.create',
            'ekstrakurikuler.store',
            'ekstrakurikuler.edit',
            'ekstrakurikuler.update',
            'ekstrakurikuler.destroy',
            'jadwal_ekstrakurikuler.index',
            'jadwal_ekstrakurikuler.create',
            'jadwal_ekstrakurikuler.store',
            'jadwal_ekstrakurikuler.edit',
            'jadwal_ekstrakurikuler.update',
            'jadwal_ekstrakurikuler.destroy',
            'laporan.index',
            'laporan.exportPDF',
            // Ketua Permissions
            'program_kegiatan.index',
            'program_kegiatan.create',
            'program_kegiatan.store',
            'program_kegiatan.edit',
            'program_kegiatan.update',
            'program_kegiatan.destroy',
            'program_kegiatan.show',
            'kehadiran.index',
            'kehadiran.create',
            'kehadiran.store',
            'kehadiran.edit',
            'kehadiran.update',
            'kehadiran.destroy',
            'kehadiran.show',
            'prestasi.index',
            'prestasi.create',
            'prestasi.store',
            'prestasi.edit',
            'prestasi.update',
            'prestasi.destroy',
            'prestasi.show',
            'pertemuan.index',
            'pertemuan.create',
            'pertemuan.store',
            'pertemuan.edit',
            'pertemuan.update',
            'pertemuan.destroy',
            'pertemuan.show',
            'chat.show',
            'chat.store',
            // Pembina Permissions
            'program_kegiatan.store',
            'program_kegiatan.show',
            'program_kegiatan.verifikasi',
            'kehadiran.store',
            'kehadiran.show',
            'kehadiran.verifikasi',
            'prestasi.store',
            'prestasi.show',
            'prestasi.verifikasi',
            'pertemuan.store',
            'pertemuan.show',
            'pertemuan.verifikasi',
        ];

        foreach ($permissions as $permission) {
            if (!Permission::where('name', $permission)->exists()) {
                Permission::create(['name' => $permission]);
            }
        }
    }

    private function createAdminRole()
    {
        if (!Role::where('name', 'Admin')->exists()) {
            $adminRole = Role::create(['name' => 'Admin']);

            $adminPermissions = ['user.index', 'user.create', 'user.store', 'user.edit', 'user.update', 'user.destroy', 'role.index', 'role.create', 'role.store', 'role.edit', 'role.update', 'role.destroy', 'role.getRoutesAllJson', 'role.getRefreshAndDeleteJson', 'dashboard', 'pembina.index', 'pembina.create', 'pembina.store', 'pembina.edit', 'pembina.update', 'pembina.destroy', 'pembina.createuser', 'pembina.storeuser', 'pembina.updateUser', 'ketua.index', 'ketua.create', 'ketua.store', 'ketua.edit', 'ketua.update', 'ketua.destroy', 'ketua.createuser', 'ketua.storeuser', 'ketua.updateUser', 'ekstrakurikuler.index', 'ekstrakurikuler.create', 'ekstrakurikuler.store', 'ekstrakurikuler.edit', 'ekstrakurikuler.update', 'ekstrakurikuler.destroy', 'jadwal_ekstrakurikuler.index', 'jadwal_ekstrakurikuler.create', 'jadwal_ekstrakurikuler.store', 'jadwal_ekstrakurikuler.edit', 'jadwal_ekstrakurikuler.update', 'jadwal_ekstrakurikuler.destroy', 'laporan.index', 'laporan.exportPDF'];

            foreach ($adminPermissions as $permission) {
                $adminRole->givePermissionTo($permission);
            }

            if (!User::where('email', 'admin@example.com')->exists()) {
                $adminUser = User::create([
                    'name' => 'Admin User',
                    'email' => 'admin@example.com',
                    'password' => Hash::make('password'),
                    'remember_token' => null,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);

                $adminUser->assignRole($adminRole);
            }
        }
    }

    private function createKetuaAndPembinaRoles()
    {
        // Create Ketua Role
        if (!Role::where('name', 'Ketua')->exists()) {
            $ketuaRole = Role::create(['name' => 'Ketua']);
            $ketuaPermissions = ['dashboard', 'program_kegiatan.index', 'program_kegiatan.create', 'program_kegiatan.store', 'program_kegiatan.edit', 'program_kegiatan.update', 'program_kegiatan.destroy', 'program_kegiatan.show', 'kehadiran.index', 'kehadiran.create', 'kehadiran.store', 'kehadiran.edit', 'kehadiran.update', 'kehadiran.destroy', 'kehadiran.show', 'prestasi.index', 'prestasi.create', 'prestasi.store', 'prestasi.edit', 'prestasi.update', 'prestasi.destroy', 'prestasi.show', 'pertemuan.index', 'pertemuan.create', 'pertemuan.store', 'pertemuan.edit', 'pertemuan.update', 'pertemuan.destroy', 'pertemuan.show', 'chat.show', 'chat.store'];
            foreach ($ketuaPermissions as $permission) {
                $ketuaRole->givePermissionTo($permission);
            }
        }

        // Create Pembina Role
        if (!Role::where('name', 'Pembina')->exists()) {
            $pembinaRole = Role::create(['name' => 'Pembina']);
            $pembinaPermissions = ['dashboard', 'program_kegiatan.index', 'program_kegiatan.store', 'program_kegiatan.show', 'program_kegiatan.verifikasi', 'kehadiran.index', 'kehadiran.store', 'kehadiran.show', 'kehadiran.verifikasi', 'prestasi.index', 'prestasi.store', 'prestasi.show', 'prestasi.verifikasi', 'pertemuan.index', 'pertemuan.store', 'pertemuan.show', 'pertemuan.verifikasi', 'chat.show', 'chat.store'];
            foreach ($pembinaPermissions as $permission) {
                $pembinaRole->givePermissionTo($permission);
            }
        }
    }

    private function insertEkstrakurikuler()
    {
        DB::table('ekstrakurikuler')->insert([
            ['id_ekstrakurikuler' => 1, 'nama' => 'Pramuka', 'deskripsi' => 'Pramuka Pangkalan MAN Demak', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id_ekstrakurikuler' => 2, 'nama' => 'Paduan Suara', 'deskripsi' => 'Paduan Suara Belezza Choir', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id_ekstrakurikuler' => 3, 'nama' => 'Paskibra', 'deskripsi' => 'Barisan Pecinta Tanah Air', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id_ekstrakurikuler' => 4, 'nama' => 'PMR', 'deskripsi' => 'Palang Merah Remaja', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id_ekstrakurikuler' => 5, 'nama' => 'KIR', 'deskripsi' => 'Karya Ilmiah Remaja', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id_ekstrakurikuler' => 6, 'nama' => 'Rebana', 'deskripsi' => 'Rebana Nurut talamidz', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id_ekstrakurikuler' => 7, 'nama' => 'Musik', 'deskripsi' => 'Manda Band', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }

    private function insertJadwalEkstrakurikuler()
{
    DB::table('jadwal_ekstrakurikuler')->insert([
        ['id_jadwal_ekstrakurikuler' => 1, 'ekstrakurikuler_id' => 1, 'hari' => 'Jumat', 'waktu' => '16:00:00', 'lokasi' => 'Lapangan Utama', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ['id_jadwal_ekstrakurikuler' => 2, 'ekstrakurikuler_id' => 2, 'hari' => 'Senin', 'waktu' => '15:00:00', 'lokasi' => 'Ruang Kelas XII 1', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ['id_jadwal_ekstrakurikuler' => 3, 'ekstrakurikuler_id' => 3, 'hari' => 'Sabtu', 'waktu' => '15:00:00', 'lokasi' => 'Lapangan Kedua', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ['id_jadwal_ekstrakurikuler' => 4, 'ekstrakurikuler_id' => 4, 'hari' => 'Rabu', 'waktu' => '14:00:00', 'lokasi' => 'Ruang UKS', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ['id_jadwal_ekstrakurikuler' => 5, 'ekstrakurikuler_id' => 5, 'hari' => 'Kamis', 'waktu' => '10:00:00', 'lokasi' => 'Ruang Kelas X 10', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ['id_jadwal_ekstrakurikuler' => 6, 'ekstrakurikuler_id' => 6, 'hari' => 'Selasa', 'waktu' => '13:00:00', 'lokasi' => 'Ruang Rebana', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ['id_jadwal_ekstrakurikuler' => 7, 'ekstrakurikuler_id' => 7, 'hari' => 'Sabtu', 'waktu' => '15:00:00', 'lokasi' => 'Ruang Musik', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
    ]);
}

    private function createKetuaUsers()
    {
        $this->createKetuaUser(2, 'Aden Muhammad Noor', 'aden@gmail.com', 'password', 1, '220037', 'Aden Muhammad Noor', 'Mranggen, Demak', 'L', '0895340452388');

        $this->createKetuaUser(3, 'Aisya Khosyi', 'aisya@gmail.com', 'password', 2, '220002', 'Aisya Khosyi', 'Bonang, Demak', 'P', '081225011289');

        $this->createKetuaUser(4, 'Ahmad Nabil Jafari', 'ahmad@gmail.com', 'password', 3, '220039', 'Ahmad Nabil Jafari', 'Mranggen, Demak', 'L', '0851789245098');

        $this->createKetuaUser(5, 'Bagus Adlim Aqil', 'bagus@gmail.com', 'password', 4, '220044', 'Bagus Adlim Aqil', 'Cangkring, Demak', 'L', '0891783594621');

        $this->createKetuaUser(6, 'Zidni Azizati', 'zidni@gmail.com', 'password', 5, '220036', 'Zidni Azizati', 'Karanganyar, Demak', 'L', '082150890697');

        $this->createKetuaUser(7, 'Shofa Ilyana', 'shofa@gmail.com', 'password', 6, '220069', 'Shofa Ilyana', 'Karangtengah, Demak', 'L', '082150890530');
    }

    private function createKetuaUser($userId, $name, $email, $password, $ekstrakurikulerId, $nis, $nama, $alamat, $jk, $noHp)
    {
        $ketuaRole = Role::where('name', 'Ketua')->first();

        if ($ketuaRole) {
            if (!User::where('email', $email)->exists()) {
                $ketuaUser = User::create([
                    'id' => $userId,
                    'name' => $name,
                    'email' => $email,
                    'password' => Hash::make($password),
                    'remember_token' => null,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);

                $ketuaUser->assignRole($ketuaRole);

                DB::table('ketua')->insert([
                    'id_ketua' => $userId,
                    'user_id' => $ketuaUser->id,
                    'ekstrakurikuler_id' => $ekstrakurikulerId,
                    'nama' => $nama,
                    'nis' => $nis,
                    'alamat' => $alamat,
                    'jk' => $jk,
                    'no_hp' => $noHp,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            } else {
                echo "User with email '{$email}' already exists.";
            }
        } else {
            echo "Role 'Ketua' does not exist.";
        }
    }

    private function createPembinaUsers()
    {
        $this->createPembinaUser(8, 'Mohamad Taufiq', 'taufiq@gmail.com', 'password', 1, 'Mohamad Taufiq', '197012311234567890', 'Sayung, Demak', 'L', '08819555831');

        $this->createPembinaUser(9, 'Anik Hudayati', 'anik@gmail.com', 'password', 1, 'Anik Hudayati', '196904122345678901', 'Cangkring, Demak', 'P', '0857555754');

        $this->createPembinaUser(10, 'Himmatul Aliyah', 'himmatul@gmail.com', 'password', 2, 'Himmatul Aliyah', '197511233456789012', 'Kadilangu, Demak', 'P', '082853555291');

        $this->createPembinaUser(11, 'Nanik Esti Wulandari ', 'nanik@gmail.com', 'password', 3, 'Nanik Esti Wulandari ', '197308154567890123', 'Tempuran, Demak', 'P', '08899555856');

        $this->createPembinaUser(12, 'Mudrikatul Khoiriyah', 'mudrik@gmail.com', 'password', 4, 'Mudrikatul Khoiriyah', '197611085678901234', 'Karanganyar, Demak', 'P', '08814555544');

        $this->createPembinaUser(13, 'Ahmad Lujito', 'lujito@gmail.com', 'password', 5, 'Ahmad Lujito', '196811306789012345', 'Guntur, Demak', 'L', '08818555825');

        $this->createPembinaUser(14, 'Wahid Anwar', 'wahid@gmail.com', 'password', 6, 'Wahid Anwar', '197204277890123456 ', 'Genuk, Semarang', 'L', '0896555160');
    }

    private function createPembinaUser($userId, $name, $email, $password, $ekstrakurikulerId, $nama, $nip, $alamat, $jk, $noHp)
    {
        $pembinaRole = Role::where('name', 'Pembina')->first();

        if ($pembinaRole) {
            if (!User::where('email', $email)->exists()) {
                $pembinaUser = User::create([
                    'id' => $userId,
                    'name' => $name,
                    'email' => $email,
                    'password' => Hash::make($password),
                    'remember_token' => null,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);

                $pembinaUser->assignRole($pembinaRole);

                // Insert into pembina table
                DB::table('pembina')->insert([
                    'id_pembina' => $userId,
                    'user_id' => $pembinaUser->id,
                    'ekstrakurikuler_id' => $ekstrakurikulerId,
                    'nama' => $nama,
                    'nip' => $nip,
                    'alamat' => $alamat,
                    'jk' => $jk,
                    'no_hp' => $noHp,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            } else {
                echo "User with email '{$email}' already exists.";
            }
        } else {
            echo "Role 'Pembina' does not exist.";
        }
    }
}
