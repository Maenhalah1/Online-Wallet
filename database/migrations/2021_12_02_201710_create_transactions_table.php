<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->decimal("amount");
            $table->char("type")->comment("d: deposit, w: withdrawal");
            $table->tinyInteger("status")->default(-1)->comment("-1: waiting, 1:accept: 0:reject");
            $table->unsignedBigInteger("user_id");
            $table->unsignedBigInteger("payment_method_id");

            $table->foreign("user_id")->references("id")->on("user")->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign("payment_method_id")->references("id")->on("payment_methods")->cascadeOnUpdate()->cascadeOnDelete();
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
        Schema::dropIfExists('transaction');
    }
}
