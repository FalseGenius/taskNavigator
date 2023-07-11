<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {



        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('description');
            $table->unsignedBigInteger('assignee_id');
            $table->date('due_date');
            $table->unsignedBigInteger('status_id')->nullable();
            $table->unsignedBigInteger('project_id')->nullable();
            $table->string('priority');
            $table->integer('estimated_time');
            $table->integer('actual_time');
            $table->timestamps();

            $table->foreign('project_id')->references('id')->on('projects');
            $table->foreign('status_id')->references('id')->on('statuses');
            $table->foreign('assignee_id')->references('id')->on('users');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
