<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{

    public function up()
    {
        Schema::connection(config('iugu.connection'))->create('customers', function(Blueprint $table){
            $table->bigInteger('id')->primary();
            $table->string('iugu_id')->index()->nullable();
            $table->string('name');
            $table->string('email');
            $table->string('cpf_cnpj')->nullable();
            $table->string('notes')->nullable();
            $table->string('number')->nullable();
            $table->string('street')->nullable();
            $table->string('district')->nullable();
            $table->string('complement')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('phone')->nullable();
            $table->string('phone_prefix')->nullable();
            $table->json('custom_variables')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::connection(config('iugu.connection'))->dropIfExists('customers');
    }
}
