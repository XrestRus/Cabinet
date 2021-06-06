<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTypePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('type__payments', function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->bigInteger("type_transaction_id")->unsigned();
            $table->timestamps();
        });

        Schema::table('type__payments', function (Blueprint $table){
            $table->foreign("type_transaction_id")->references("id")
                ->on("type__transactions")
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
        Schema::dropIfExists('type__payments');
    }
}
