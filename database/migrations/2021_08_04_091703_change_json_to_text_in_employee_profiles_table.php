<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeJsonToTextInEmployeeProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employee_profiles', function (Blueprint $table) {
            $table->text('skills', 200)->nullable()->change();
            $table->text('certifications', 200)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employee_profiles', function (Blueprint $table) {
            $table->json('skills')->nullable()->change();
            $table->json('certifications')->nullable()->change();
        });
    }
}
