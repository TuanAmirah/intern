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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('designation_id')->nullable();
            $table->unsignedBigInteger('userimage_id')->nullable();
            $table->string('nric_no')->nullable();
            $table->string('phone_no')->nullable();
            $table->string('address')->nullable();
            $table->string('department')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('designation_id')->references('id')->on('designations');
            $table->foreign('userimage_id')->references('id')->on('images');
  
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};