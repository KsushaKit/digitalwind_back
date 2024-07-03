<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('img');
            $table->text('text');
            $table->date('date');
            $table->timestamps();
        });

        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('text');
            $table->string('img');
            $table->date('date');
            $table->integer('max_members');
            $table->integer('current_members');
            $table->timestamps();
        });

        Schema::create('age_groups', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->timestamps();
        });

        Schema::create('tours', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->double('status')->nullable();
            $table->timestamps();
        });

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('login');
            $table->string('password');
            $table->enum('role', ['admin', 'jury', 'attendee']);
            $table->timestamps();
        });

        Schema::create('juries', function (Blueprint $table) {
            $table->id();
            $table->string('surname');
            $table->string('name');
            $table->string('patronymic');
            $table->string('email')->unique();
            $table->string('nominations')->nullable();
            $table->string('age_categories')->nullable();
            $table->string('tours')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('age_group_juries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('age_group_id');
            $table->foreign('age_group_id')->references('id')->on('age_groups')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('jury_id');
            $table->foreign('jury_id')->references('id')->on('juries')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('tour_juries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('jury_id');
            $table->foreign('jury_id')->references('id')->on('juries')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('tour_id');
            $table->foreign('tour_id')->references('id')->on('tours')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('surname');
            $table->string('name');
            $table->string('patronymic');
            $table->string('email')->unique();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('attendees', function (Blueprint $table) {
            $table->id();
            $table->string('surname');
            $table->string('name');
            $table->string('patronymic')->nullable();
            $table->date('birth_date');
            $table->string('email')->unique();
            $table->string('phone_number');
            $table->string('country');
            $table->string('region')->nullable();
            $table->string('city');
            $table->string('add_educational')->default('Не имеется')->nullable();
            $table->string('educational_institution_type')->default('Не имеется')->nullable();
            $table->string('educational_institution')->default('Не имеется')->nullable();
            $table->string('institute')->default('Не имеется')->nullable();
            $table->string('specialization')->default('Не имеется')->nullable();
            $table->string('course')->default('Не имеется')->nullable();
            $table->string('class')->default('Не имеется')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('nominations', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->timestamps();
        });

        Schema::create('nomination_ageGroups', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('nomination_id');
            $table->foreign('nomination_id')->references('id')->on('nominations')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('age_group_id');
            $table->foreign('age_group_id')->references('id')->on('age_groups')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('nomination_tours', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('nomination_id');
            $table->foreign('nomination_id')->references('id')->on('nominations')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('tour_id');
            $table->foreign('tour_id')->references('id')->on('tours')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('nomination_juries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('nomination_id');
            $table->foreign('nomination_id')->references('id')->on('nominations')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('jury_id');
            $table->foreign('jury_id')->references('id')->on('juries')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('creations', function (Blueprint $table) {
            $table->id();
            $table->string('attendee_name');
            $table->string('attendee_surname');
            $table->string('attendee_pathronymic')->nullable();
            $table->string('age')->nullable();
            $table->string('title');
            $table->string('img');
            $table->string('rating');
            $table->text('description');
            $table->string('file')->nullable();
            $table->text('link')->nullable();
            $table->enum('status', ['На рассмотрении', 'Одобрена', 'Отклонена'])->default('На рассмотрении');
            $table->enum('round', ['1', '2', '3', 'Выставить этап'])->nullable();
            $table->string('other_attendee')->nullable();
            $table->string('project_manager')->nullable();
            $table->unsignedBigInteger('tour_id');
            $table->foreign('tour_id')->references('id')->on('tours')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('nomination_id');
            $table->foreign('nomination_id')->references('id')->on('nominations')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('age_group_id');
            $table->foreign('age_group_id')->references('id')->on('age_groups')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('attendee_id');
            $table->foreign('attendee_id')->references('id')->on('attendees')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('creation_juries', function (Blueprint $table) {
            $table->id();
            $table->string('score1')->nullable();
            $table->string('score2')->nullable();
            $table->unsignedBigInteger('creation_id');
            $table->foreign('creation_id')->references('id')->on('creations')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('jury_id');
            $table->foreign('jury_id')->references('id')->on('juries')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('rounds', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

    }

    public function down()
    {
        Schema::dropIfExists('rounds'); //1
        Schema::dropIfExists('creation_juries'); //2
        Schema::dropIfExists('creations'); //3
        Schema::dropIfExists('nomination_tours'); //4
        Schema::dropIfExists('nomination_juries'); //5
        Schema::dropIfExists('nomination_ageGroups'); //6
        Schema::dropIfExists('nominations'); //7
        Schema::dropIfExists('attendees'); //8
        Schema::dropIfExists('admins'); //9
        Schema::dropIfExists('tour_juries'); //10
        Schema::dropIfExists('age_group_juries'); //11
        Schema::dropIfExists('juries'); //12
        Schema::dropIfExists('users'); //13
        Schema::dropIfExists('tours'); //14
        Schema::dropIfExists('age_groups'); //15
        Schema::dropIfExists('news'); //16
    }
}
