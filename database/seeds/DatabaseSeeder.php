<?php

use Illuminate\Database\Seeder;
use App\User;


class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();

        $this->call(UsersTableSeeder::class);
        $this->command->info('User table seeded!');
    }
}

Class UsersTableSeeder extends Seeder {
    public function run()
    {
        DB::table('users')->delete();

        User::create(array(
            'email' => 'member@email.com',
            'password' => Hash::make('password'),
            'name' => 'John Doe',
            'admin' => 0
        ));

        User::create(array(
            'email' => 'admin@store.com',
            'password' => Hash::make('adminpassword'),
            'name' => 'Jennifer Taylor',
            'admin' => 1
        ));
    }
}
