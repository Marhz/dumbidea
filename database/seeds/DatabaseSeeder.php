<?php

use Illuminate\Database\Seeder;
use Psy\Command\WtfCommand;
use App\Award;
use App\Tag;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        factory('App\Award', 20)->create();
        factory('App\Tag', 8)->create();
        foreach (Award::all() as $award) {
            $tagsNb = rand(2, 6);            
            $tags = Tag::inRandomOrder()->take($tagsNb)->get();
            $award->tags()->sync($tags);
            $nbComment = rand(0, 10);
            factory('App\Comment', rand(0, 10))->create(['award_id' => $award->id]);
        }
        factory('App\User')->create([
            'email' => 'test@mail.com',
            'password' => bcrypt('azerty')
        ]);
    }
}
