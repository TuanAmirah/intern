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
        Schema::create('reasons', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('analysis_id');
            $table->unsignedBigInteger('user_id');
            $table->string('issue');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('analysis_id')->references('id')->on('analyses')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reasons');
    }
};
