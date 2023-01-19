<?php

namespace LaravelEnso\Tasks\Contracts;

use Carbon\Carbon;
use LaravelEnso\Tasks\Enums\Flag;
use LaravelEnso\Users\Models\User;

interface Taskable
{
    public function name(): string;

    public function description(): string;

    public function allocatedTo(): ?User;

    public function createdBy(): ?User;

    public function updatedBy(): ?User;

    public function reminder(): Carbon;

    public function flag(): ?Flag;

    public function completed(): bool;
}
