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
        Schema::create('courses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->date('start_date');
            $table->float('price');
            $table->string('duration');
            $table->text('description');

            $table->bigInteger('instructor_id')->unsigned()->nullable();
            $table->foreign('instructor_id')->references('id')->on('users')->onDelete('cascade');

            $table->bigInteger('specialization_id')->unsigned();
			$table->foreign('specialization_id')->references('id')->on('specializations')->onDelete('cascade');

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
        Schema::dropIfExists('courses');
    }
};
