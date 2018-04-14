<?php
namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Redis;
use Illuminate\Http\UploadedFile;
use App\Trending;
use App\Exceptions\PostTooOftenException;

class AwardTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    function it_updates_the_latest_award_list()
    {
        $this->signIn();
        Redis::del('testing_awards_list');
        $this->withoutExceptionHandling();
        $award = $this->makeAward();
        $this->post(route('awards.store'), $award);
        $awards = array_map('json_decode', Redis::lrange('testing_awards_list', 0, 4));
        $this->assertCount(1, $awards);
    }
    
    /**
     * @test
     */
    function a_user_can_only_post_1_award_per_day()
    {
        $this->signIn();
        $this->withoutExceptionHandling();
        create('App\Award', ['user_id' => auth()->id()]);
        $award = $this->makeAward();
        $this->expectException('App\Exceptions\PostTooOftenException');
        $this->post(route('awards.store', $award))
            ->assertStatus(302);
    }

    protected function makeAward()
    {
        $award = make('App\Award')->toArray();
        $award['image'] = UploadedFile::fake()->image('image.jpg');
        $award['tags'] = [];
        return $award;
    }
}
