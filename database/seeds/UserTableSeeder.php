<?php

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
        DB::table('users')->insert([
          'name' => 'Diky Arga',
            'username' => 'dikyarga',
            'email' => 'hello@dikyarga.com',
            'password' => bcrypt('secret'),
            'role' => 'admin',
            'created_at' => Carbon\Carbon::now(),
            'updated_at' => Carbon\Carbon::now(),
        ]);
        for ($i=0; $i < 10; $i++) {
          #
          DB::table('users')->insert([
            'name' => str_random(10),
              'username' => str_random(10),
              'email' => str_random(10).'@gmail.com',
              'password' => bcrypt('secret'),
              'role' => 'anggota';
              'created_at' => Carbon\Carbon::now(),
              'updated_at' => Carbon\Carbon::now(),
          ]);
        }


    }
}
