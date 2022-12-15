<?php

use Illuminate\Database\Seeder;
use App\User;
use Carbon\Carbon;

class AboutTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\About::create([
            'tentang_kami' => 'PT. Someah Kreatif Nusantara adalah perusahaan teknologi informasi yang bergerak dalam penyediaan beragam jasa konstruksi dan pengembangan perangkat lunak.',
            'visi' => 'Menjadi perusahaan teknologi informasi yang profesional, mampu menciptakan produk teknologi yang kreatif & inovatif, serta tepat guna dalam konteks pembangunan Indonesia.',
            'misi' => 'somearch',
        ]);
    }
}
