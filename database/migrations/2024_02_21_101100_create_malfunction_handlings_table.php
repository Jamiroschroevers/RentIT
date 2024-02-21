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
        Schema::create('malfunction_handlings', function (Blueprint $table) {
            $table->id();
            $table->text('description');
            $table->text('activities');
            $table->string('material');
            $table->integer('mileage');
            $table->integer('cost');
            $table->unsignedBigInteger('image_id')->nullable();
            $table->foreign('image_id')->references('id')->on('images')->onDelete('cascade');
            $table->unsignedBigInteger('malfunction_id')->nullable();
            $table->foreign('malfunction_id')->references('id')->on('malfunctions')->onDelete('cascade');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('malfunction_handlings');
    }
};
