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
        Schema::create('tests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('hospital_id')->constrained()->onDelete('cascade');
            $table->foreignId('test_name_id')->constrained()->onDelete('cascade');
            $table->string('patient_name', 100);
            $table->string('blood_group', 100)->nullable();
            $table->string('gender', 5);
            $table->integer('weight')->nullable();
            $table->date('dob');
            $table->string('status', 20)->default('Requested');
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
        Schema::dropIfExists('tests');
    }
};
