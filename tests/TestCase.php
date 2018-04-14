<?php

namespace Tests;

use Illuminate\Http\UploadedFile;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function setUp()
    {
        parent::setUp();
        Storage::fake('public');
    }
    protected function signIn($user = null)
    {
        $user = $user ? : create('App\User');
        $this->actingAs($user);
        return $this;
    }
    
    protected function makeAward()
    {
        $award = make('App\Award')->toArray();
        $award['image'] = UploadedFile::fake()->image('image.jpg');
        $award['tags'] = [];
        return $award;
    }
    
    protected function fakeImage()
    {
        Image::shouldReceive('make')->andReturn(new FakeImage);
    }
}

Class FakeImage {
    public function save()
    {

    }

    public function fit()
    {
        return $this;
    }
    
    public function __toString()
    {
        return '';
    }
}
