<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlansTable extends Migration
{

    public function up()
    {
        Schema::create('plans', function(Blueprint $table) {
            $table->id();
            $table->string('iugu_id')->index()->nullable();
            $table->string('name');
            $table->string('identifier');
            $table->bigInteger('interval');
            $table->enum('interval_type',['weeks','months'])->default('months');
            $table->bigInteger('value_cents');
            $table->string('payable_with')->nullable();
            $table->json('features')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('plans');
    }
}
