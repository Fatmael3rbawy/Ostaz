<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMethodUserTable extends Migration {

	public function up()
	{
		Schema::create('method_user', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->bigInteger('method_id')->unsigned();
            $table->foreign('method_id')->references('id')->on('methods')->onDelete('cascade');
			$table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

		});
	}

	public function down()
	{
		Schema::drop('method_user');
	}
}