<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAttachmentablesTable extends Migration {

	public function up()
	{
		Schema::create('attachmentables', function(Blueprint $table) {
			$table->bigInteger('attachment_id')->unsigned();
            $table->foreign('attachment_id')->references('id')->on('attachments')->onDelete('cascade');
			$table->timestamps();
			$table->integer('attachmentable_id');
			$table->string('attachmentable_type');
			$table->string('key')->default(null);
		});
	}

	public function down()
	{
		Schema::drop('attachmentables');
	}
}