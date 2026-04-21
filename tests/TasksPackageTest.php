<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Notification;
use LaravelEnso\Forms\TestTraits\CreateForm;
use LaravelEnso\Forms\TestTraits\DestroyForm;
use LaravelEnso\Forms\TestTraits\EditForm;
use LaravelEnso\Tables\Traits\Tests\Datatable;
use LaravelEnso\Tasks\Models\Task;
use LaravelEnso\Tasks\Notifications\TaskNotification;
use LaravelEnso\Users\Models\User;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class TasksPackageTest extends TestCase
{
    use CreateForm, Datatable, DestroyForm, EditForm, RefreshDatabase;

    private string $permissionGroup = 'tasks';
    private User $user;
    private Task $testModel;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed();
        $this->user = User::first();
        $this->actingAs($this->user);

        $this->testModel = Task::factory()->make([
            'allocated_to' => $this->user->id,
            'completed' => false,
            'created_by' => $this->user->id,
            'updated_by' => $this->user->id,
            'reminder' => Carbon::now()->addHour(),
        ]);
    }

    #[Test]
    public function can_store_task(): void
    {
        $response = $this->post(
            route('tasks.store', [], false),
            $this->testModel->toArray()
        );

        $task = Task::query()
            ->whereName($this->testModel->name)
            ->first();

        $response->assertStatus(200)
            ->assertJsonStructure(['message'])
            ->assertJsonFragment([
                'redirect' => 'tasks.edit',
                'param' => ['task' => $task?->id],
            ]);

        $this->assertNotNull($task);
    }

    #[Test]
    public function can_update_task(): void
    {
        $this->testModel->save();
        $this->testModel->name = 'Updated task';

        $this->patch(
            route('tasks.update', $this->testModel->id, false),
            $this->testModel->toArray()
        )->assertStatus(200)
            ->assertJsonStructure(['message']);

        $this->assertSame('Updated task', $this->testModel->fresh()->name);
    }

    #[Test]
    public function validates_past_reminder_when_it_changes(): void
    {
        $this->post(route('tasks.store', [], false), [
            'name' => $this->testModel->name,
            'description' => $this->testModel->description,
            'flag' => $this->testModel->flag,
            'allocated_to' => $this->user->id,
            'completed' => false,
            'reminder' => Carbon::now()->subMinute()->toDateTimeString(),
        ])->assertStatus(302)
            ->assertSessionHasErrors(['reminder']);
    }

    #[Test]
    public function count_endpoint_returns_pending_and_overdue_totals(): void
    {
        Task::factory()->create([
            'allocated_to' => $this->user->id,
            'completed' => false,
            'reminder' => Carbon::now()->subHour(),
        ]);

        Task::factory()->create([
            'allocated_to' => $this->user->id,
            'completed' => false,
            'reminder' => Carbon::now()->addHour(),
        ]);

        Task::factory()->create([
            'allocated_to' => $this->user->id,
            'completed' => true,
            'reminder' => Carbon::now()->subHour(),
        ]);

        $this->get(route('tasks.count', [], false))
            ->assertStatus(200)
            ->assertExactJson([
                'overdueCount' => 1,
                'pendingCount' => 2,
            ]);
    }

    #[Test]
    public function index_endpoint_returns_only_pending_tasks_for_the_current_user(): void
    {
        $pendingTask = Task::factory()->create([
            'allocated_to' => $this->user->id,
            'completed' => false,
        ]);

        Task::factory()->create([
            'allocated_to' => $this->user->id,
            'completed' => true,
        ]);

        $otherUser = User::factory()->create();

        Task::factory()->create([
            'allocated_to' => $otherUser->id,
            'completed' => false,
        ]);

        $this->get(route('tasks.index', [
            'offset' => 0,
            'paginate' => 10,
        ], false))->assertStatus(200)
            ->assertJsonCount(1)
            ->assertJsonFragment(['id' => $pendingTask->id]);
    }

    #[Test]
    public function send_reminders_command_notifies_only_overdue_unreminded_tasks(): void
    {
        Notification::fake();

        $overdueTask = Task::factory()->create([
            'allocated_to' => $this->user->id,
            'completed' => false,
            'reminder' => Carbon::now()->subHour(),
            'reminded_at' => null,
        ]);

        $alreadyRemindedTask = Task::factory()->create([
            'allocated_to' => $this->user->id,
            'completed' => false,
            'reminder' => Carbon::now()->subHour(),
            'reminded_at' => Carbon::now()->subMinutes(5),
        ]);

        $futureTask = Task::factory()->create([
            'allocated_to' => $this->user->id,
            'completed' => false,
            'reminder' => Carbon::now()->addHour(),
            'reminded_at' => null,
        ]);

        Task::factory()->create([
            'allocated_to' => $this->user->id,
            'completed' => true,
            'reminder' => Carbon::now()->subHour(),
            'reminded_at' => null,
        ]);

        $this->artisan('enso:tasks:send-reminders')
            ->assertExitCode(0);

        Notification::assertSentTo($this->user, TaskNotification::class);
        Notification::assertCount(1);

        $this->assertNotNull($overdueTask->fresh()->reminded_at);
        $this->assertNotNull($alreadyRemindedTask->fresh()->reminded_at);
        $this->assertNull($futureTask->fresh()->reminded_at);
    }
}
