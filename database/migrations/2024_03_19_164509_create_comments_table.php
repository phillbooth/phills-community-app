<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->uuid('id')->primary(); // Set 'id' as UUID and primary key
            $table->text('body'); // The actual comment text
            $table->uuid('article_id'); // Assuming articles also use UUIDs
            $table->uuid('user_id'); // Assuming users also use UUIDs
            $table->timestamps(); // Timestamps for created_at and updated_at

            // Foreign keys assuming 'articles' and 'users' tables use UUIDs
            $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
