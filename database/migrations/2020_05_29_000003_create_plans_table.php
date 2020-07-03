<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlansTable extends Migration
{

    public function up()
    {
        Schema::connection(config('iugu.connection'))->create('plans', function(Blueprint $table) {
            $table->bigIncrements('id')->primary();
            $table->string('iugu_id')->index()->nullable();
            $table->string('name');
            $table->string('identifier');
            $table->bigInteger('interval');
            $table->enum('interval_type',['weeks','months'])->nullable();
            $table->bigInteger('value_cents');
            $table->string('payable_with')->nullable();
            $table->json('features')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::connection(config('iugu.connection'))->dropIfExists('plans');
    }
}
