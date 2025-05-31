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
        Schema::create('attendees', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->timestamp('registered_at')->nullable();
            $table->foreignId('event_id')
                  ->constrained('events')
                  ->onDelete('cascade');
            $table->unique(['email', 'event_id'], 'unique_attendee_per_event');
            $table->unique(['phone', 'event_id'], 'unique_attendee_phone_per_event');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendees');
    }
};
