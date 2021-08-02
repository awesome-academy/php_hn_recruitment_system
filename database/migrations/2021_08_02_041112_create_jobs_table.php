<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employer_profile_id')->constrained();
            $table->foreignId('field_id')->constrained();
            $table->string('title');
            $table->text('description');
            $table->string('location');
            $table->string('job_type');
            $table->string('contact_email');
            $table->integer('quantity');
            $table->unsignedBigInteger('salary');
            $table->text('requirement');
            $table->text('benefit');
            $table->string('image')->nullable();
            $table->integer('status');
            $table->dateTime('close_at');
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
        Schema::dropIfExists('jobs');
    }
}
