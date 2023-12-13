<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('films', function (Blueprint $table) {
            $table->id();
            $table->string('judulFilm');
            $table->date('rilis');
            $table->string('genre');
            $table->decimal('rating');
            $table->text('deskripsi');
            $table->string('photo_path')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // In a migration file
        Schema::table('films', function (Blueprint $table) {
            $table->string('photo_path')->nullable();
        });
    }
};