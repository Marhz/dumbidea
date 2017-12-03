<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Storage;

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
}
