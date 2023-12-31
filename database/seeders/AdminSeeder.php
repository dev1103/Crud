<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user = User::updateOrCreate([
            'email' => 'admin@admin.com'
        ],[
            'name' => 'admin',
            'password' => Hash::make('password')
        ]);
    }
}
