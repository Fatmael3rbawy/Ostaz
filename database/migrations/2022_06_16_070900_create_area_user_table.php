<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAreaUserTable extends Migration {

	public function up()
	{
		Schema::create('area_user', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
			$table->bigInteger('area_id')->unsigned();
        	$table->foreign('area_id')->references('id')->on('areas')->onDelete('cascade');
		});
	}

	public function down()
	{
		Schema::drop('area_user');
	}
}