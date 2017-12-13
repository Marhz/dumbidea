<?php
namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Trending;
use Psy\Command\HistoryCommand;

class TeendingTest extends TestCase
{
    use RefreshDatabase;

    public function setUp()
    {
        parent::setUp();
        $this->trending = new Trending();
        $this->trending->reset();
    }

    /**
     * @test
     */
    function it_gives_1_point_when_an_award_is_visited()
    {
        $award = create('App\Award');
        $this->assertCount(0, $this->trending->get());
        $this->get($award->path());
        $trending = $this->trending->getWithScores();
        $this->assertCount(1, $trending);
        $this->assertEquals(1, $trending[0]->_score);
    }

    /**
     * @test
     */
    function it_gives_2_points_when_a_comment_is_submitted()
    {
        $this->signIn();
        $award = create('App\Award');
        $response = $this->post(route('comments.post', [$award->id]), ['content' => 'test']);
        $trending = $this->trending->getWithScores();
        $this->assertEquals(2, $trending[0]->_score);
    }
}
