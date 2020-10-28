<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->text('description');
            $table->tinyInteger('flag')->nullable()->index();
            $table->boolean('completed')->index();
            $table->dateTime('reminder')->nullable();

            $table->unsignedInteger('allocated_to')->nullable()->index();
            $table->foreign('allocated_to')->references('id')->on('users');
            $table->unsignedInteger('created_by')->nullable()->index();
            $table->foreign('created_by')->references('id')->on('users');
            $table->unsignedInteger('updated_by')->nullable()->index();
            $table->foreign('updated_by')->references('id')->on('users');

            $table->dateTime('reminded_at')->nullable()->index();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
