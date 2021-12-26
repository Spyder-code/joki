<?php

namespace Database\Seeders;

use App\Models\FileType;
use Illuminate\Database\Seeder;

class TypeFileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'Soal',
            'Progress',
            'Finish',
        ];

        foreach ($data as $item ) {
            FileType::create([
                'name' => $item
            ]);
        }
    }
}
