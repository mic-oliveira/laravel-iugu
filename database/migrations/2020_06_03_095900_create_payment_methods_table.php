<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentMethodsTable extends Migration
{

    public function up()
    {
        Schema::connection(config('iugu.connection'))->create('payment_methods', function (Blueprint $table) {
            $table->bigInteger('id')->primary();
            $table->string('iugu_id')->index()->nullable();
            $table->string('customer_id')->nullable();
            $table->string('description');
            $table->string('token');
            $table->boolean('set_as_default')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::connection(config('iugu.connection'))->dropIfExists('payment_methods');
    }
}
