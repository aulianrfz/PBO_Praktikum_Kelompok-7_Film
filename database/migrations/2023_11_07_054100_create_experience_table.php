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
        Schema::create('experience', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('personal_id');
            $table->string('Company_name')->nullable();
            $table->string('Loc_org')->nullable();
            $table->string('Start_date_org')->nullable();
            $table->date('End_date_org')->nullable();
            $table->string('Job_desc')->nullable();
            $table->string('Job_title')->nullable();
            $table->foreign('personal_id')->references('id')->on('personal')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('experience');
    }
};
