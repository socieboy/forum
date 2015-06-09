<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepliesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Create replies table

        Schema::create('replies', function (Blueprint $table) {

            $table->engine = 'InnoDB';
            $table->increments('id');

            $table->text('message');

            $table->integer('conversation_id')->unsigned();
            $table->foreign('conversation_id')
                ->references('id')->on('conversations')->onDelete('cascade');
            
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')
                ->references('id')->on('users')->onDelete('cascade');

            $table->boolean('correct_answer')->default(false);
            
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
        // Delete table replies
        
        Schema::drop('replies');
	}

}
