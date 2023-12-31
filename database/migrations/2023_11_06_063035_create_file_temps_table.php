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
        Schema::create('file_temps', function (Blueprint $table) {
            $table->id();
            $table->string('ref_no');
            $table->string('file_name');
            $table->string('file_type'); 
            $table->string('file_size');
            $table->string('file_path');
            $table->string('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('file_temps');
    }
};
