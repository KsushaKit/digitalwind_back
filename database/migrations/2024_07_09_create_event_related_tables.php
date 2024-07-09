<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EventRelatedTables extends Migration
{
    public function up()
    {
        // Create events table
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->string('location');
            $table->string('target_audience');
            $table->integer('max_members');
            $table->integer('current_members')->default(0);
            $table->timestamps();
        });

        // Create speakers table
        Schema::create('speakers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('position');
            $table->timestamps();
        });

        // Create event_speaker pivot table
        Schema::create('event_speaker', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained('events')->onDelete('cascade');
            $table->foreignId('speaker_id')->constrained('speakers')->onDelete('cascade');
            $table->timestamps();
        });

        // Create images table
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->string('url');
            $table->foreignId('event_id')->constrained('events')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('images');
        Schema::dropIfExists('event_speaker');
        Schema::dropIfExists('speakers');
        Schema::dropIfExists('events');
    }
}
