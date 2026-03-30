<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Config;
use LaravelEnso\Users\Models\User;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class AllocateToRolesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed();

        $this->actingAs(User::first());
    }

    #[Test]
    public function can_limit_roles()
    {
        Config::set('enso.tasks.roles', []);

        $this->get(route('tasks.users'))->assertJson([]);
    }

    #[Test]
    public function can_select_all_roles()
    {
        Config::set('enso.tasks.roles', ['*']);

        $this->get(route('tasks.users'))->assertJsonCount(User::count());
    }
}
