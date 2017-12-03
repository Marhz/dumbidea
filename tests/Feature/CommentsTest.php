<?php
namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CommentsTest extends TestCase
{
    use RefreshDatabase;
    
    public function setUp()
    {
        parent::setUp();
        $this->withoutExceptionHandling();        
    }

    /**
     * @test
     */
    function a_list_of_comments_can_be_fetched_for_an_award()
    {
        $this->withoutExceptionHandling();
        $award = create('App\Award');
        create('App\Comment', ['award_id' => $award->id], 5);
        $this->getJson("api/awards/{$award->id}/comments")
            ->assertStatus(200)
            ->assertJsonCount(5);
    }

    /**
     * @test
     */
    function a_logged_in_user_can_create_a_comment()
    {
        $this->signIn();
        $award = create('App\Award');
        $comment = make('App\Comment')->toArray();
        $this->postJson(route('comments.post', ['awardId' => $award->id]), $comment)
            ->assertStatus(200);
        $this->assertEquals(1, $award->fresh()->comments()->count());
    }

    /**
     * @test
     */
    function guests_cannot_comment()
    {
        $this->withExceptionHandling();
        $award = create('App\Award');
        $comment = make('App\Comment')->toArray();
        $this->postJson(route('comments.post', ['award' => $award->id]), $comment)
            ->assertStatus(401);        
    }

    /**
     * @test
     */
    function a_user_can_delete_his_own_comment()
    {
        $comment = create('App\Comment');
        $this->signIn($comment->user);
        $this->deleteJson(route('comments.destroy', ['comment' => $comment->id]))
            ->assertStatus(200);
        $this->assertDatabaseMissing('comments', ['id' => $comment->id]);
    }

    /**
     * @test
     */
    function a_user_cannot_delete_other_users_comments()
    {
        $this->withExceptionHandling();
        $this->signIn();
        $comment = create('App\Comment');
        $this->deleteJson(route('comments.destroy', ['comment' => $comment->id]))
            ->assertStatus(403);
        $this->assertDatabaseHas('comments', ['id' => $comment->id]);        
    }

    /**
     * @test
     */
    function a_user_can_update_his_comment()
    {
        $comment = create('App\Comment');
        $this->signIn($comment->user);
        $edit = "edited comment";
        $this->patchJson(route('comments.update', ['comment' => $comment->id]), ['content' => $edit])
            ->assertStatus(200);
        $this->assertEquals($edit, $comment->fresh()->content);
    }

    /**
     * @test
     */
    function a_user_cannot_edit_other_users_comments()
    {
        $this->withExceptionHandling();
        $this->signIn();
        $comment = create('App\Comment');
        $edit = "edited comment";
        $this->patchJson(route('comments.update', ['comment' => $comment->id]), ['content' => $edit])
            ->assertStatus(403);
        $this->assertNotEquals($edit, $comment->fresh()->content);        
    }
}
