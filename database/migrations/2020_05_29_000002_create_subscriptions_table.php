<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionsTable extends Migration
{
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->string('iugu_id')->index()->nullable();
            $table->string('customer_id')->index()->nullable();
            $table->string('plan_identifier');
            $table->boolean('only_on_charge_success');
            $table->boolean('ignore_due_email');
            $table->integer('price_cents');
            $table->enum('payable_with',['all','credit_card','bank_slip'])->nullable();
            $table->boolean('credits_based')->default(false);
            $table->bigInteger('credits_cycle')->nullable();
            $table->bigInteger('credits_min')->nullable();
            $table->boolean('two_steps')->nullable();
            $table->boolean('suspend_on_invoice_expired')->nullable();
            $table->foreignId('client_id')->constrained('customers');
            $table->date('expire_at')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('subscriptions');
    }
}
