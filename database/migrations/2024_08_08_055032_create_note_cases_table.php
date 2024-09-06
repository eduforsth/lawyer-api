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
            $table->string('client_name')->nullable();
            $table->string('case_name')->nullable();
            $table->string('case_no')->nullable();
            $table->string('court_name')->nullable();
            $table->string('tayalo_name')->nullable();
            $table->string('tayakhan_name')->nullable();
            $table->string('tayalo_lawyer_name')->nullable();
            $table->string('tayakhan_lawyer_name')->nullable();
            $table->string('case_accepted_date')->default('');
            $table->string('next_hearing_date')->nullable();
            $table->string('alarm')->nullable();
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
