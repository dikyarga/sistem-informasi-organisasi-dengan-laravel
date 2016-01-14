<?php

use Illuminate\Database\Seeder;
use App\Comments;

class CommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $faker = \Faker\Factory::create();

      

      for ($i=0; $i < 10; $i++)
      {
        $user = App\User::All()->random(1);
        $post = App\Posts::All()->random(1);

        Comments::create([
          'on_post' => $post->id,
          'from_user' => $user->id,
          'body' => $faker->text,
          ]);

      }
    }
}
