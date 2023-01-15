<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAttachmentsTable extends Migration {

	public function up()
	{
		Schema::create('attachments', function(Blueprint $table) {
			$table->bigIncrements('id');
			$table->timestamps();
			$table->softDeletes();
			// $table->bigInteger('attachmentable_id')->unsigned()->index();
			// $table->string('attachmentable_type')->index();
			$table->text('file');
		});
	}

	public function down()
	{
		Schema::drop('attachments');
	}
}