<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChargesTable extends Migration
{
    public function up()
    {
        Schema::connection(config('iugu.connection'))->create('charges', function (Blueprint $table) {
            $table->bigInteger('id')->primary();
            $table->string('token');
            $table->integer('discount_cents')->nullable();
            $table->string('customer_id')->nullable();
            $table->integer('months')->nullable();
            $table->string('method')->nullable();
            $table->string('email')->nullable();
            $table->string('customer_payment_method_id')->nullable();
            $table->integer('bank_slip_extra_days')->comment('Se vazio aplica valor padrão de 3 dias')->nullable();
            $table->string('order_id')->nullable();
            $table->json('items');
            $table->string('message')->nullable();
            $table->json('errors')->nullable();
            $table->boolean('success')->nullable();
            $table->string('url')->nullable();
            $table->string('pdf')->nullable();
            $table->string('identificarion')->nullable();
            $table->string('invoice_id')->nullable();
            $table->string('lr')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::connection(config('iugu.connection'))->dropIfExists('charges');
    }

}
