<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("type_payment")->unsigned();
            $table->string("comment")->nullable()->default(null);
            $table->bigInteger("user_id")->unsigned();
            $table->integer("clock")->default(0);
            $table->integer("days")->default(0);
            $table->decimal("sum", 18, 2);
            $table->date("date");
            $table->timestamps();
        });

        Schema::table('payments', function (Blueprint $table){
            $table->foreign("user_id")->references("id")
                ->on("users")
                ->onUpdate("cascade")
                ->onDelete("cascade");
            $table->foreign("type_payment")
                ->references("id")
                ->on("type__payments")
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
        Schema::dropIfExists('payments');
    }
}
