<?php

namespace Database\Seeders;

use App\Models\NotificationType;
use Illuminate\Database\Seeder;

class NotificationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'Pesanan selesai dibuat. Harap segera konfirmasi Admin untuk melakukan pembayaran DP.',
            'Pembayaran DP berhasil. Pesanan sedang dikerjakan.',
            'Pesanan telah selesai. Silahkan anda cek.',
            'Pesanan berhasil dibatalkan.',
            'Revisi berhasil diajukan.',
        ];

        foreach ($data as $item ) {
            NotificationType::create([
                'message' => $item
            ]);
        }
    }
}
