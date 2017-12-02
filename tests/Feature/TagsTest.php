<?php
namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Tag;
use Illuminate\Http\UploadedFile;

class TagsTest extends TestCase
{
    use RefreshDatabase;

    public function setUp()
    {
        parent::setUp();
        $this->signIn();
        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    function it_creates_given_tags()
    {
        $award = make('App\Award')->toArray();
        $award['image'] = UploadedFile::fake()->image('image.jpg');
        $award['tags'] = ['tag1', 'tag2'];
        $response = $this->post(route('awards.store'), $award)
            ->assertStatus(302);
        $this->assertEquals(2, Tag::count());
    }

    /**
     * @test
     */
    function it_only_creates_new_tags()
    {
        create('App\Tag', ['name' => 'tag1', 'slug' => 'tag1']);
        $award = make('App\Award')->toArray();
        $award['image'] = UploadedFile::fake()->image('image.jpg');
        $award['tags'] = ['tag1', 'tag2'];
        $response = $this->post(route('awards.store'), $award)
            ->assertStatus(302);
        $this->assertEquals(2, Tag::count());
    }

    /**
     * @test
     */
    function it_ignores_duplicate_tags()
    {
        create('App\Tag', ['name' => 'tag1', 'slug' => 'tag1']);
        $award = make('App\Award')->toArray();
        $award['image'] = UploadedFile::fake()->image('image.jpg');
        $award['tags'] = ['tag1', 'tag2', 'tag2'];
        $response = $this->post(route('awards.store'), $award)
            ->assertStatus(302);
        $this->assertEquals(2, Tag::count());
    }

    /**
     * @test
     */
    function it_gets_all_awards_for_a_tag()
    {
        $tag1 = create('App\Tag', ['name' => 'tag1', 'slug' => 'tag1']);
        $tag2 = create('App\Tag', ['name' => 'tag2', 'slug' => 'tag2']);
        
        $award = create('App\Award');
        $otherAward = create('App\Award');
        
        $award->syncTags([$tag1->name]);
        $otherAward->syncTags([$tag1->name, $tag2->name]);

        $this->get(route('tag.show', ['tag' => $tag1->id]))
            ->assertSee($award->title)
            ->assertSee($otherAward->title);

        $this->get(route('tag.show', ['tag' => $tag2->id]))
            ->assertSee($otherAward->title)
            ->assertDontSee($award->title);
    }
}