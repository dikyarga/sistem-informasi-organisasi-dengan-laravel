<?php

use App\Posts;
use App\User;
use Illuminate\Database\Seeder;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $faker = \Faker\Factory::create();

      //Posts::truncate();
      foreach(range(1,10) as $index)
      {
        $user = User::All()->random(1);
        Posts::create([
          'author_id' => $user->id,
          'title'     => $faker->sentence(3),
          'body'      => $faker->text,
          'slug'      => $faker->slug(),
          'active'    => 1,
          ]);
      }
    }
}
