<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Contact::create([
            'alamat' => 'Jl. Ir. H. Juanda Kelurahan No.203B, Dago, Kecamatan Coblong, Kota Bandung, Jawa Barat 40135',
            'alamat_link' => 'https://g.page/someah?share',
            'email' => 'info@someah.id',
            'telepon' => '628562294222',
            'instagram' => 'https://www.instagram.com/someahkreatif/',
            'linkedin' => 'https://www.linkedin.com/company/somearch-nusantara/',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
