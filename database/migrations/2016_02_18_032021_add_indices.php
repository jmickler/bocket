<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIndices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bookmarks', function (Blueprint $table) {
            $table->index('user_id');
        });
        Schema::table('tags', function (Blueprint $table) {
            $table->index('user_id');
        });
        Schema::table('bookmark_tag', function (Blueprint $table) {
            $table->index(['tag_id', 'bookmark_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bookmarks', function (Blueprint $table) {
            $table->dropIndex('bookmarks_user_id_index');
        });
        Schema::table('tags', function (Blueprint $table) {
            $table->dropIndex('tags_user_id_index');
        });
        Schema::table('bookmark_tag', function (Blueprint $table) {
            $table->dropIndex('bookmark_tag_tag_id_bookmark_id_index');
        });
    }
}
