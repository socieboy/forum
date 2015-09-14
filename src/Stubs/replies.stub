<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Config;

class CreateRepliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $databasePrefix = (Config::get('forum.database.prefix') ? Config::get('forum.database.prefix') . '_' : '');

        // Create replies table
        Schema::create(
            $databasePrefix . 'replies',
            function (Blueprint $table) use ($databasePrefix) {
                $table->engine = 'InnoDB';

                $table->increments('id');
                $table->text('message');
                $table->integer('conversation_id')->unsigned();
                $table->foreign('conversation_id')
                    ->references('id')->on($databasePrefix . 'conversations')->onDelete('cascade');

                $table->integer('user_id')->unsigned();
                $table->foreign('user_id')
                    ->references('id')->on('users')->onDelete('cascade');

                $table->boolean('correct_answer')->default(false);
                $table->timestamps();
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $databasePrefix = (Config::get('forum.database.prefix') ? Config::get('forum.database.prefix') . '_' : '');

        // Delete table replies
        Schema::drop($databasePrefix . 'replies');
    }

}
