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
        Schema::create('day_categories', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('day_name', 50);
            $table->string('weekdays', 50)->nullable();
            $table->enum('repeat', ['once', 'everyday', 'every week', 'every fortnight', 'every month', 'every 3 month', 'every 6 month', 'every year'])->default('once');//once = 1, everyday =2, everyweek = 3, everyfortnight = 4, everymonth = 5, everythreemonth = 6, everysixmonth = 7, everyyear = 8;
            $table->date('start_date');
            $table->date('next_date')->nullable();
            $table->enum('status', ['active', 'paused']);
            $table->timestamps();
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('day_categories');
    }
};
