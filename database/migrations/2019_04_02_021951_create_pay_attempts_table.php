<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePayAttemptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pay_attempts', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('user_id');
            $table->float('mount');
            $table->string('description');
            $table->string('request_id')->nullable();
            $table->string('process_url')->nullable();
            $table->string('status')->nullable();
            $table->string('reason')->nullable();
            $table->string('franchise')->nullable();
            $table->string('bank')->nullable();
            $table->string('internalReference')->nullable();
            $table->string('paymentMethod')->nullable();
            $table->string('paymentMethodName')->nullable();
            $table->string('issuerName')->nullable();
            $table->string('authorization')->nullable();
            $table->string('receipt')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('Users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pay_attempts');
    }
}
