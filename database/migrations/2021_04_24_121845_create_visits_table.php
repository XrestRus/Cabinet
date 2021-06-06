<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visits', function (Blueprint $table) {
            $table->id();
            $table->integer("clock");
            $table->bigInteger("type_mark_id")->unsigned();;
            $table->date("date");
            $table->bigInteger("user_id")->unsigned();;
            $table->timestamps();
        });

        Schema::table('visits', function (Blueprint $table){
            $table->foreign("type_mark_id")
                ->references("id")
                ->on("type__marks")
                ->onDelete("cascade")
                ->onUpdate("cascade");
            $table->foreign("user_id")
                ->references("id")
                ->on("users")
                ->onDelete("cascade")
                ->onUpdate("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('visits');
    }
}
