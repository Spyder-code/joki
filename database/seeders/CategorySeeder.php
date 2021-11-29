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
            'Jasa'
        ];

        foreach ($data as $item ) {
            Category::create([
                'name' => $item
            ]);
        }
    }
}
