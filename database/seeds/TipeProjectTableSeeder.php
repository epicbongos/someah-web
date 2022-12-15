<?php

use Illuminate\Database\Seeder;
use App\TipeProject;
use Illuminate\Support\Str;

class TipeProjectTableSeeder extends Seeder
{
    public function run()
    {
        TipeProject::create([
            'tipe_project' => 'Aplikasi Mobile',
            'slug' => Str::slug('Aplikasi Mobile','-'),
            'gambar' => 'none',
        ]);

        TipeProject::create([
            'tipe_project' => 'Aplikasi Website',
            'slug' => Str::slug('Aplikasi Website','-'),
            'gambar' => 'none',
        ]);

        TipeProject::create([
            'tipe_project' => 'Aplikasi Desktop',
            'slug' => Str::slug('Aplikasi Desktop','-'),
            'gambar' => 'none',
        ]);

        TipeProject::create([
            'tipe_project' => 'Sistem Informasi',
            'slug' => Str::slug('Sistem Informasi','-'),
            'gambar' => 'none',
        ]);
    }
}
