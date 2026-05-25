<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run migrations
     */
    public function up(): void
    {
        Schema::create('schedules', function (Blueprint $table) {

            $table->id();

            /*
                mass OR meeting
            */
            $table->string('type');

            /*
                Sunday Mass
                Monthly Meeting
            */
            $table->string('title');

            $table->date('date');

            $table->time('time');

            $table->string('venue')->nullable();

            $table->text('agenda')->nullable();

            /*
                Assigned members + attendance
            */
            $table->json('members')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse migrations
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};