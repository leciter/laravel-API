<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
            User::create([
                'name' => 'Cassie',
                'lastname' => 'Marfe',
                'status' => 1,
                'phone' => '+111111111',
                'password' => '111111',
            ]);
        factory(App\User::class, 100)->create();
    }
}
