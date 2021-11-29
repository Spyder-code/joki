<?php

namespace Database\Seeders;

use App\Models\TransactionStatus;
use Illuminate\Database\Seeder;

class TransactionStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'Pending',
            'On progress',
            'Finish',
            'Cancel'
        ];

        foreach ($data as $item ) {
            TransactionStatus::create([
                'name' => $item
            ]);
        }
    }
}
