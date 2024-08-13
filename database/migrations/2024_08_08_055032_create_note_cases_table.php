<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNoteCasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('note_cases', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('supervisor_id')->default('0');
            $table->integer('lawyer_id')->default('0');
            $table->integer('client_id')->default('0');
            $table->string('client_name');
            $table->string('court_name');
            $table->string('judge_name')->nullable();
            $table->string('case_name');
            $table->string('case_no')->nullable();
            $table->string('case_year')->nullable();
            $table->string('other_party_name')->nullable();
            $table->string('opposite_advocate_name')->nullable();
            $table->string('previous_hearing_date');
            $table->string('next_hearing_date')->nullable();
            $table->string('case_accepted_date')->nullable();
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
        Schema::dropIfExists('note_cases');
    }
}
