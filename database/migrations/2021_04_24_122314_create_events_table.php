<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("user_author_id")->unsigned();;
            $table->string("title");
            $table->string("desc");
            $table->date("date_start");
            $table->date("date_end");
            $table->timestamps();
        });

        Schema::table('events', function (Blueprint $table){
            $table->foreign("user_author_id")->references("id")
                ->on("users")
                ->onUpdate("cascade")
                ->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
