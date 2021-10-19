<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNutritionalValueElementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nutritional_value_elements', function (Blueprint $table) {
            $table->id();
             $table->string('element');
            $table->integer('element_value');
            $table->bigInteger('nutrvalue_id')->unsigned();
            $table->foreign('nutrvalue_id')->references('id')->on('nutritional_values')->onDelete('cascade');

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
        Schema::dropIfExists('nutritional_value_elements');
    }
}
