<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentMethodCurrenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_method_currencies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("payment_method_id");
            $table->unsignedBigInteger("currency_id");

            $table->foreign("payment_method_id")->references("id")->on("payment_methods")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign("currency_id")->references("id")->on("currencies")->cascadeOnDelete()->cascadeOnUpdate();
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
        Schema::dropIfExists('payment_method_currencies');
    }
}
