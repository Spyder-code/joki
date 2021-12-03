<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'Makalah',
            'Skripsi',
            'Desain',
            'Writing',
            'Program',
            'Power Point',
            'Resume',
            'Statistika',
            'Review',
            'Soal SMA',
            'Soal Kuliah',
            'Komputer',
            'Art',
            'Edit Video',
            'Decoration',
        ];

        foreach ($data as $item ) {
            Category::create([
                'name' => $item
            ]);
        }
    }
}
