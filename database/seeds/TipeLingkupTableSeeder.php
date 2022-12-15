<?php

use Illuminate\Database\Seeder;
use App\TipeLingkup;
use Illuminate\Support\Str;

class TipeLingkupTableSeeder extends Seeder
{
    public function run()
    {
        TipeLingkup::create([
            'tipe_lingkup' => 'Baru',
            'slug' => Str::slug('Baru','-'),
        ]);

        TipeLingkup::create([
            'tipe_lingkup' => 'Melanjutkan',
            'slug' => Str::slug('Melanjutkan','-'),
        ]);
    }
}
