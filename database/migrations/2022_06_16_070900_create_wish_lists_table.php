<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWishListsTable extends Migration {

	public function up()
	{
		Schema::create('wishlists', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
			$table->bigInteger('favourite_id')->unsigned()->nullable();
            $table->foreign('favourite_id')->references('id')->on('users')->onDelete('cascade');
		});
	}

	public function down()
	{
		Schema::drop('wish_lists');
	}
}