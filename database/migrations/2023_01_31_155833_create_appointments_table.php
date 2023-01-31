<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('hospital_id')->unsigned()->nullable();
            $table->integer('doctor_id')->unsigned()->nullable();
            $table->string('patient_name', 100);
            $table->string('blood_group', 100)->nullable();
            $table->string('gender', 1);
            $table->integer('weight')->nullable();
            $table->date('dob');
            $table->string('status', 15)->default('Requested');
            $table->text('comments')->nullable();
            $table->string('test_report_path')->nullable();
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
        Schema::dropIfExists('appointments');
    }
};
