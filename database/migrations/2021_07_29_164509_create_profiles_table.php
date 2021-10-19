<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string("activity");
            $table->enum("gender",['male','female']);
            $table->integer("length");
            $table->integer("age");
            $table->integer("weight");
            $table->integer("bmi");
            $table->string("aims");
            $table->string("diseasesName")->nullable();
            $table->string("bmivalue");
            $table->string("calories");
            $table->string("notes")->nullable();
            $table->string("medicine")->nullable();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

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
        Schema::dropIfExists('profiles');
    }
}
