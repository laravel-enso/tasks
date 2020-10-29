<?php

namespace LaravelEnso\Tasks;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\ServiceProvider;
use LaravelEnso\Core\Models\User;
use LaravelEnso\DynamicMethods\Services\Methods;
use LaravelEnso\Tasks\Commands\SendTaskReminders;
use LaravelEnso\Tasks\DynamicRelations\AllocatedTasks;
use LaravelEnso\Tasks\Models\Task as Model;
use LaravelEnso\Tasks\Observers\Task as Observer;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->load()
            ->publish()
            ->command()
            ->relations()
            ->observers();
    }

    private function load(): self
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/api.php');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        return $this;
    }

    private function publish(): self
    {
        $this->publishes([
            __DIR__ . '/../config' => config_path('laravel-enso'),
        ], 'tasks-config');

        $this->publishes([
            __DIR__.'/../client/src/js' => base_path('client/src/js'),
        ], 'tasks-assets');

        return $this;
    }


    private function command(): self
    {
        $this->commands(SendTaskReminders::class);

        $this->app->booted(fn () => $this->app->make(Schedule::class)
            ->command('enso:tasks:send-reminders')->everyMinute());

        return $this;
    }

    public function relations(): self
    {
        Methods::bind(User::class, [AllocatedTasks::class]);

        return $this;
    }

    public function observers()
    {
        Model::observe(Observer::class);
    }

    public function register()
    {
        //
    }
}
