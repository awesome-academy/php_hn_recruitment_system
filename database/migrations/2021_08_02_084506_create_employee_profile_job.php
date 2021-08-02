<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeProfileJob extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_profile_job', function (Blueprint $table) {
            $table->id();
            $table
                ->foreignId('employee_profile_id')
                ->constrained()
                ->cascadeOnDelete();
            $table
                ->foreignId('job_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->tinyInteger('status');
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
        Schema::dropIfExists('employee_profile_job');
    }
}
