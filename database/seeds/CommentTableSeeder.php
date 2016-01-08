<?php

use Illuminate\Database\Seeder;

class CommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $user = App\User::All()->random(1);
      $post = App\Posts::All()->random(1);

      DB::table('comments')->insert([
          'on_post' => $post->id,
          'from_user' => $user->id,
          'body' => str_random(5).' ' . str_random(4) .' ' . str_random(7),
          'created_at' => Carbon\Carbon::now(),
          'updated_at' => Carbon\Carbon::now(),
      ]);
    }
}
