<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Config;
use LaravelEnso\Core\Models\User;
use Tests\TestCase;

class AllocatedToTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed();

        $this->actingAs(User::first());
    }

    /** @test */
    public function can_limit_roles()
    {
        Config::set('enso.tasks.allocatedTo.roles', []);

        $this->get(route('tasks.allocatedTo.options'))->assertJson([]);
    }
}
