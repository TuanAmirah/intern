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
        Schema::create('analyses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('project_id');
            $table->unsignedBigInteger('phase_id');
            $table->unsignedBigInteger('status_id')->default(1);
            $table->string('notes');
            $table->date('deadline');
            $table->time('timeline');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('project_id')->references('id')->on('projects');
            $table->foreign('phase_id')->references('id')->on('phases');
            $table->foreign('status_id')->references('id')->on('statuses');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('analyses');
    }
};