<?php

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
      $user = App\User::All()->random(1);

      for ($i=0; $i < 10; $i++) {
        DB::table('posts')->insert([
            'author_id' => $user->id,
            'title' => str_random(5).' ' . str_random(4) .' ' . str_random(7),
            'body' => str_random(5).' ' . str_random(4) .' ' . str_random(7),
            'slug' => str_slug(str_random(5), "-"),
            'active' => 1,
            'created_at' => Carbon\Carbon::now(),
            'updated_at' => Carbon\Carbon::now(),
        ]);
      }
    }
}
