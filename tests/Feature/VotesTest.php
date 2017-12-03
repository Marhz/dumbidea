<?php
namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VotesTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    function a_user_can_upvote()
    {
        $this->signIn();
        $award = create('App\Award');
        $this->post($award->path() . '/upvote')
            ->assertStatus(200);
        $this->assertDatabaseHas('votes', [
            'user_id' => auth()->id(),
            'award_id' => $award->id,
            'value' => 1
        ]);
    }

    /**
     * @test
     */
    function a_user_can_downvote()
    {
        $this->signIn();
        $award = create('App\Award');
        $this->post($award->path() . '/downvote')
            ->assertStatus(200);
        $this->assertDatabaseHas('votes', [
            'user_id' => auth()->id(),
            'award_id' => $award->id,
            'value' => -1
        ]);
    }

    /**
     * @test
     */
    function upvotes_are_canceled()
    {
        $this->signIn();
        $award = create('App\Award');
        $this->post($award->path() . '/upvote');        
        $this->post($award->path() . '/upvote')
            ->assertStatus(200);
        $this->assertDatabaseMissing('votes', [
            'user_id' => auth()->id(),
            'award_id' => $award->id,
        ]);
    }

    /**
     * @test
     */
    function downvotes_are_canceled()
    {
        $this->signIn();
        $award = create('App\Award');
        $this->post($award->path() . '/downvote');
        $this->post($award->path() . '/downvote')
            ->assertStatus(200);
        $this->assertDatabaseMissing('votes', [
            'user_id' => auth()->id(),
            'award_id' => $award->id,
        ]);        
    }

    /**
     * @test
     */
    function upvotes_are_swapped_for_downvote()
    {
        $this->signIn();
        $award = create('App\Award');
        $this->post($award->path() . '/upvote');
        $this->post($award->path() . '/downvote')
            ->assertStatus(200);
        $this->assertDatabaseHas('votes', [
            'user_id' => auth()->id(),
            'award_id' => $award->id,
            'value' => -1
        ]);
    }

    /**
     * @test
     */
    function downvotes_are_swapped_for_upvote()
    {
        $this->withoutExceptionHandling();
        $this->signIn();
        $award = create('App\Award');
        $this->post($award->path() . '/downvote');
        $this->post($award->path() . '/upvote')
            ->assertStatus(200);
        $this->assertDatabaseHas('votes', [
            'user_id' => auth()->id(),
            'award_id' => $award->id,
            'value' => 1
        ]);
    }
}
