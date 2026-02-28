<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'kristine hannah e, tano',
                'email' => 'admin@lashnbeauty.com',
                'password' => Hash::make('password123'),
                'role' => 'admin',
                'phone' => '09123456789',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Regular Client',
                'email' => 'client@example.com',
                'password' => Hash::make('password123'),
                'role' => 'client',
                'phone' => '09987654321',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('services')->insert([
            [
                'name' => 'Classic Lash Extension',
                'description' => 'A natural mascara look perfect for everyday wear.',
                'price' => 500.00,
                'duration_minutes' => 90,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Eyebrow Threading',
                'description' => 'Precise hair removal for perfectly shaped brows.',
                'price' => 150.00,
                'duration_minutes' => 20,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('appointments')->insert([
            [
                'user_id' => 2,
                'service_id' => 1,
                'scheduled_at' => Carbon::tomorrow()->setTime(10, 0),
                'status' => 'confirmed',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('transactions')->insert([
            [
                'appointment_id' => 1,
                'amount' => 500.00,
                'payment_method' => 'cash',
                'status' => 'paid',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('settings')->insert([
            ['key' => 'store_hours', 'value' => '9:00 AM - 8:00 PM', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'contact_email', 'value' => 'hello@lashnbeauty.com', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'contact_phone', 'value' => '+63 912 345 6789', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'store_address', 'value' => 'Bais City, Negros Oriental', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
