<?php

use Illuminate\Database\Seeder;
use App\TipeKarir;
use Illuminate\Support\Str;

class TipeKarirTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipeKarir::create([
            'tipe_karir' => 'Full Time',
            'slug' => Str::slug('Full Time','-'),
        ]);

        TipeKarir::create([
            'tipe_karir' => 'Part Time',
            'slug' => Str::slug('Part Time','-'),
        ]);

        TipeKarir::create([
            'tipe_karir' => 'Remote',
            'slug' => Str::slug('Remote','-'),
        ]);

        TipeKarir::create([
            'tipe_karir' => 'Permanent',
            'slug' => Str::slug('Permanent','-'),
        ]);

        TipeKarir::create([
            'tipe_karir' => 'Internship',
            'slug' => Str::slug('Internship','-'),
        ]);

    }
}
