<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocotorDatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('docotor_dates', function (Blueprint $table) {
            $table->id();
            $table->enum('day',['Thursday','Wednesday','Tuesday','Monday','Sunday','Saturday','Friday']);
            $table->string('from_hour');
            $table->string("to_hour");
            $table->bigInteger('user_id')->unsigned();
            $table->enum('status',['فعال','غير فعال','محجوز']);
            $table->string('user_name')->nullable();
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
        Schema::dropIfExists('docotor_dates');
    }
}
