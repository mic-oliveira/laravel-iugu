<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    public function up()
    {
        Schema::connection(config('iugu.connection'))->create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('iugu_id')->index()->nullable();
            $table->string('email');
            $table->string('status')->nullable();
            $table->string('order_id')->nullable();
            $table->date('due_date');
            $table->boolean('ensure_workday_due_date')->nullable();
            $table->string('currency')->nullable();
            $table->bigInteger('total_cents')->nullable();
            $table->bigInteger('discount_cents')->nullable();
            $table->string('return_url')->nullable();
            $table->string('expire_url')->nullable();
            $table->string('secure_id')->nullable();
            $table->string('secure_url')->comment('Link para pagamento')->nullable();
            $table->string('notification_url')->nullable();
            $table->boolean('ignore_canceled_email')->nullable();
            $table->boolean('fines')->nullable();
            $table->bigInteger('late_payment_fines')->default(0);
            $table->boolean('ignore_due_email')->nullable();
            $table->json('custom_variables')->nullable();
            $table->integer('installments')->nullable();
            $table->bigInteger('transaction_number')->nullable();
            $table->string('payment_method')->nullable();
            $table->json('items');
            $table->boolean('early_payment_discount')->default(false);
            $table->json('early_payment_discounts')->nullable()
                ->comment('Quantidade de dias de antecedência para o
                pagamento receber o desconto (Se enviado, substituirá a configuração atual da conta)');
            $table->string('customer_id')->nullable();
            $table->string('subscription_id')->nullable();
            $table->json('logs')->nullable();
            $table->string('credit_card_band')->nullable();
            $table->string('credit_card_bin')->nullable();
            $table->string('credit_card_last_four')->nullable();
            $table->string('credit_card_tid')->nullable();
            $table->string('paid')->nullable();
            $table->dateTime('captured_at')->nullable();
            $table->dateTime('authorized_at')->nullable();
            $table->dateTime('refund_at')->nullable();
            $table->dateTime('canceled_atd')->nullable();
            $table->dateTime('chargeback_at')->nullable();
            $table->dateTime('expired_at')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::connection(config('iugu.connection'))->dropIfExists('invoices');
    }

}
