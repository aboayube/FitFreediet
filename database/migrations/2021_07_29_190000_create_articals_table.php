<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articals', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('content');
            $table->longText('discription');
            $table->unsignedTinyInteger('status')->default(0);
            $table->unsignedTinyInteger('comment_able')->default(1);
            $table->string('image');
            $table->enum("type",['posts','wasfas']);
             $table->foreignId('user_id')->constrained()->onDelete('cascade');
             $table->foreignId('category_id')->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('articals');
    }
}
