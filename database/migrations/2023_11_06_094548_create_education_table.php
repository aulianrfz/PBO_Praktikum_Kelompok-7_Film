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
        Schema::create('education', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('personal_id');
            $table->string('Edu_institution')->nullable();
            $table->string('Loc_edu')->nullable();
            $table->string('Start_date_edu')->nullable();
            $table->date('End_date_edu')->nullable();
            $table->string('Achievment')->nullable();
            $table->string('Education_level')->nullable();
            $table->foreign('personal_id')->references('id')->on('personal')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('education');
    }
};
