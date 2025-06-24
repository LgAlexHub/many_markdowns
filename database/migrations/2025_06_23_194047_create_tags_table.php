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
        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->string('label');
            $table->string('color', 10);
            $table->timestamps();
        });

        Schema::create('note_tag', function (Blueprint $table){
            $table->bigInteger('note_id');
            $table->bigInteger('tag_id');
            $table->unique(['note_id', 'tag_id']);
            $table->foreign('note_id')->references('id')->on('users');
            $table->foreign('tag_id')->references('id')->on('tags');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tags');
        Schema::dropIfExists('note_tag');
    }
};
