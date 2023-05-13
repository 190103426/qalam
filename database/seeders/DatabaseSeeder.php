<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        User::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
         \App\Models\User::factory(10)->create();
         \App\Models\User::create([
             'phone' => 7777777,
             'is_admin' => true,
             'password' => Hash::make('password'),
             'email' => 'admin@mail.ru',
             'full_name' => 'Admin'
         ]);
         $this->call(CoursesSeeder::class);
    }
}
