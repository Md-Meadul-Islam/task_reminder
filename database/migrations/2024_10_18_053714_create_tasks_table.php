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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->unsignedBigInteger('day_category_id');
            $table->text('task_body');
            $table->string('remark', 300)->nullable();
            $table->time('alarm_time');
            $table->integer('remind_before')->nullable();
            $table->integer('remind_after')->nullable();
            $table->string('ringtone', 20)->default('default_tone.mp3');
            $table->enum('status', ['pending', 'done'])->default('pending');
            $table->timestamps();
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('day_category_id')->references('id')->on('day_categories')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
