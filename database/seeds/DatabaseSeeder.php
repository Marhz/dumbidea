<?php

use Illuminate\Database\Seeder;
use Psy\Command\WtfCommand;
use App\Award;
use App\Tag;
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
        // $this->call(UsersTableSeeder::class);
        $awards = factory('App\Award', 20)->create();
        factory('App\Tag', 8)->create();
        foreach ($awards as $award) {
            $tagsNb = rand(2, 6);            
            $tags = Tag::inRandomOrder()->take($tagsNb)->get();
            $award->tags()->sync($tags);
            $nbComment = rand(0, 10);
            factory('App\Comment', rand(0, 10))->create(['award_id' => $award->id]);
        }
        $me = factory('App\User')->create([
            'email' => 'test@mail.com',
            'password' => bcrypt('azerty')
        ]);
        $myAwards = factory('App\Award', 30)->create(['user_id' => $me->id]);
        $myComments = factory('App\Comment', 30)->create(['award_id' => $awards->shuffle()[0]->id, 'user_id' => $me->id]);
        foreach($myAwards as $award) {
            $votesNb = rand(0, 20);
            factory('App\Comment', rand(0, 15))->create(['award_id' => $award->id]);
            for($i = 0; $i < $votesNb; $i++) {
                try {
                    $award->votes()->attach(User::all()->shuffle()[0]->id, ['value' => rand(0, 1) >= 0.5 ? 1 : -1]);

                }
                catch(Exception $e) {

                }
            }
        }
        foreach ($myComments as $comment) {
            $votesNb = rand(0, 20);
            for ($i = 0; $i < $votesNb; $i++) {
                try {
                    $comment->votes()->attach(User::all()->get()->shuffle()[0]->id, ['value' => rand(0, 1) >= 0.5 ? 1 : -1]);

                }
                catch (Exception $e) {

                }
            }
        }
    }
}
