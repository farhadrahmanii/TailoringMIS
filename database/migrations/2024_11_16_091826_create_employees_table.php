<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('lastName')->nullable();
            $table->string('FatherName')->nullable();
            $table->string('Position')->nullable();
            $table->string('Education')->nullable();
            $table->string('salary')->nullable();
            $table->string('tazkira')->nullable();
            $table->string('date_of_contract')->nullable();
            $table->string('end_date_of_contract')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('Address')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
