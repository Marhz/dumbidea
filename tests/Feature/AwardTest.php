<?php
namespace Tests\Feature;

use App\Award;
use App\Trending;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Redis;
use Intervention\Image\Facades\Image;
use App\Exceptions\PostTooOftenException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class AwardTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    function it_updates_the_latest_award_list()
    {
        $this->signIn();
        $this->fakeImage();
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
}
