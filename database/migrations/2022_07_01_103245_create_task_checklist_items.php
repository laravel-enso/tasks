<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('task_checklist_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('task_id')->constrained('tasks');

            $table->string('name');
            $table->unsignedInteger('order_index')->nullable();
            $table->boolean('is_completed');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('task_checklist_items');
    }
};
