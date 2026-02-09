<?php

use Illuminate\Database\Seeder;
use App\Models\WorkArea;
use App\Models\User;

class WorkAreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminId = 1; // Default to ID 1 if no user found
        try {
            $admin = User::first();
            if ($admin) {
                $adminId = $admin->id;
            }
        } catch (\Exception $e) {
            // Table might not exist yet during fresh migration
        }

        $data = [
            // KANTOR PUSAT
            [
                'wilayah_kerja' => 'kantor_pusat',
                'kab_kota' => 'Jakarta Pusat',
                'kantor_cabang' => 'Kantor Pusat BPJS Kesehatan',
                'deputi_direktorat' => 'Direktorat Kepesertaan',
                'created_by' => $adminId,
                'updated_by' => $adminId,
            ],
            // KEDEPUTIAN WILAYAH
            [
                'wilayah_kerja' => 'kantor_wilayah',
                'kab_kota' => 'Semarang',
                'kantor_cabang' => 'Kedeputian Wilayah VI (Jateng & DIY)',
                'deputi_direktorat' => 'Bidang Kepesertaan dan Pelayanan Peserta',
                'created_by' => $adminId,
                'updated_by' => $adminId,
            ],
            [
                'wilayah_kerja' => 'kantor_wilayah',
                'kab_kota' => 'Bandung',
                'kantor_cabang' => 'Kedeputian Wilayah IV (Jawa Barat)',
                'deputi_direktorat' => 'Bidang Penjaminan Manfaat Rujukan',
                'created_by' => $adminId,
                'updated_by' => $adminId,
            ],
            // KANTOR CABANG
            [
                'wilayah_kerja' => 'kantor_cabang',
                'kab_kota' => 'Jakarta Selatan',
                'kantor_cabang' => 'Kantor Cabang Jakarta Selatan',
                'deputi_direktorat' => 'Unit Penagihan dan Keuangan',
                'created_by' => $adminId,
                'updated_by' => $adminId,
            ],
            [
                'wilayah_kerja' => 'kantor_cabang',
                'kab_kota' => 'Surabaya',
                'kantor_cabang' => 'Kantor Cabang Surabaya',
                'deputi_direktorat' => 'Unit Manajemen Kesehatan Primer',
                'created_by' => $adminId,
                'updated_by' => $adminId,
            ],
        ];

        foreach ($data as $item) {
            WorkArea::create($item);
        }
    }
}
