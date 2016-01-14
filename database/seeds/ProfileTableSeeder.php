<?php

use App\Profile;
use App\User;
use Illuminate\Database\Seeder;

class ProfileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $faker = \Faker\Factory::create();

      foreach(range(1,10) as $index)
      {
        $user = User::All()->random(1);
        Profile::create([
          'user_id' => $user->id,
          'telephone' => $faker->phoneNumber,
          'telegram' => $faker->username,

          ]);
      }
    }
}
