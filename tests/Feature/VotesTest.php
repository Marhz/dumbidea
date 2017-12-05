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
        $this->withoutExceptionHandling();
        $this->signIn();
        $award = create('App\Award');
        $this->post(route('upvote', [
            'model' => 'awards',
            'id' => $award->id
        ]))->assertStatus(200);
        $this->assertDatabaseHas('votes', [
            'user_id' => auth()->id(),
            'vote_id' => $award->id,
            'vote_type' => 'App\Award',
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
        $this->post(route('downvote', [
            'model' => 'awards',
            'id' => $award->id
        ]))->assertStatus(200);
        $this->assertDatabaseHas('votes', [
            'user_id' => auth()->id(),
            'vote_id' => $award->id,
            'vote_type' => 'App\Award',
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
        $this->post(route('upvote', [
            'model' => 'awards',
            'id' => $award->id
        ]));
        $this->post(route('upvote', [
            'model' => 'awards',
            'id' => $award->id
        ]))->assertStatus(200);
        $this->assertDatabaseMissing('votes', [
            'user_id' => auth()->id(),
            'vote_id' => $award->id,
            'vote_type' => 'App\Award',
        ]);
    }

    /**
     * @test
     */
    function downvotes_are_canceled()
    {
        $this->signIn();
        $award = create('App\Award');
        $this->post(route('downvote', [
            'model' => 'awards',
            'id' => $award->id
        ]));
        $this->post(route('downvote', [
            'model' => 'awards',
            'id' => $award->id
        ]))->assertStatus(200);
        $this->assertDatabaseMissing('votes', [
            'user_id' => auth()->id(),
            'vote_id' => $award->id,
            'vote_type' => 'App\Award',
        ]);        
    }

    /**
     * @test
     */
    function upvotes_are_swapped_for_downvote()
    {
        $this->signIn();
        $award = create('App\Award');
        $this->post(route('upvote', [
            'model' => 'awards',
            'id' => $award->id
        ]));
        $this->post(route('downvote', [
            'model' => 'awards',
            'id' => $award->id
        ]))->assertStatus(200);
        $this->assertDatabaseHas('votes', [
            'user_id' => auth()->id(),
            'vote_id' => $award->id,
            'vote_type' => 'App\Award',
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
        $this->post(route('downvote', [
            'model' => 'awards',
            'id' => $award->id
        ]));
        $this->post(route('upvote', [
            'model' => 'awards',
            'id' => $award->id
        ]))->assertStatus(200);
        $this->assertDatabaseHas('votes', [
            'user_id' => auth()->id(),
            'vote_id' => $award->id,
            'vote_type' => 'App\Award',
            'value' => 1
        ]);
    }

    /**
     * @test
     */
    function a_user_can_upvote_comments()
    {
        $this->withoutExceptionHandling();
        $this->signIn();
        $comment = create('App\Comment');
        $this->post(route('upvote', [
            'model' => 'comments',
            'id' => $comment->id
        ]))->assertStatus(200);
        $this->assertDatabaseHas('votes', [
            'user_id' => auth()->id(),
            'vote_id' => $comment->id,
            'vote_type' => 'App\Comment',
            'value' => 1
        ]);
    }
}
