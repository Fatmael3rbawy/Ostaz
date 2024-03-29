<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSpecializationsTable extends Migration {

	public function up()
	{
		Schema::create('specializations', function(Blueprint $table) {
			$table->bigIncrements('id');
			$table->timestamps();
			$table->softDeletes();
			$table->string('name');
			
		});
	}

	public function down()
	{
		Schema::drop('specializations');
	}
}