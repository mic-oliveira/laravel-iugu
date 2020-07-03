<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionsTable extends Migration
{
    public function up()
    {
        Schema::connection(config('iugu.connection'))->create('subscriptions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('iugu_id')->index()->nullable();
            $table->string('customer_id')->index();
            $table->string('plan_identifier')->nullable();
            $table->boolean('only_on_charge_success')->nullable();
            $table->boolean('ignore_due_email')->nullable();
            $table->integer('price_cents');
            $table->enum('payable_with',['all','credit_card','bank_slip'])->nullable();
            $table->boolean('credits_based')->nullable();
            $table->bigInteger('credits_cycle')->nullable();
            $table->bigInteger('credits_min')->nullable();
            $table->boolean('two_steps')->nullable();
            $table->boolean('suspend_on_invoice_expired')->nullable();
            $table->date('expire_at')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::connection(config('iugu.connection'))->dropIfExists('subscriptions');
    }
}
