<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CommandTest extends TestCase
{
    public function test_logic()
    {
        $this->artisan('test:logic 3 5 6 0 7 0 1')->assertSuccessful();
    }

    public function test_refactor_code()
    {
        $this->artisan('test:refactor')->assertSuccessful();
    }
}
