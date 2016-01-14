<?php

use App\User;

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
        DB::table('users')->insert([
            'name' => 'Diky Arga',
            'username' => 'dikyarga',
            'email' => 'hello@dikyarga.com',
            'password' => bcrypt('secret'),
            'role' => 'admin',
            'created_at' => Carbon\Carbon::now(),
            'updated_at' => Carbon\Carbon::now(),
        ]);
        */

        $faker = \Faker\Factory::create();

        foreach(range(1,10) as $index)
        {
          User::create([
            'name' => $faker->name,
            'username'     => $faker->firstName($gender = null|'male'|'female'),
            'email'      => $faker->email,
            'password'      => bcrypt('secret'),
            'role'    => 'anggota',

            ]);
        }


    }
}
