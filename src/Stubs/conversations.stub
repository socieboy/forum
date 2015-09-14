<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Config;

class CreateConversationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $databasePrefix = (Config::get('forum.database.prefix') ? Config::get('forum.database.prefix') . '_' : '');

        // Create conversations table.
        Schema::create(
            $databasePrefix . 'conversations',
            function (Blueprint $table) {
                $table->engine = 'InnoDB';

                $table->increments('id');
                $table->string('title');
                $table->text('message');
                $table->text('topic_id');
                $table->integer('user_id')->unsigned();
                $table->foreign('user_id')
                    ->references('id')->on('users')->onDelete('cascade');

                $table->string('slug');
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

        // Delete conversations table.
        Schema::drop($databasePrefix . 'conversations');
    }
}
