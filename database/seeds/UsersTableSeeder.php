<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Make test account
        factory(User::class)->create([
            'name' => 'Shane',
            'email' => 'olivershan@gmail.com',
            'password' => Hash::make('12345678'),
            'admin' => true,
        ]);
    }
}
