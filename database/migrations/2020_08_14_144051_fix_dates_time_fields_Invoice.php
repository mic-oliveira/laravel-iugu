<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FixDatesTimeFieldsInvoice extends Migration
{
    public function up()
    {
        Schema::connection(config('iugu.connection'))->table('invoices', function (Blueprint $table) {
            $table->dateTimeTz('captured_at_iso')->nullable()->change();
            $table->dateTimeTz('canceled_at_iso')->nullable()->change();
            $table->dateTimeTz('authorized_at_iso')->nullable()->change();
            $table->dateTimeTz('refunded_at_iso')->nullable()->change();
            $table->dateTimeTz('protested_at_iso')->nullable()->change();
            $table->dateTimeTz('chargeback_at_iso')->nullable()->change();
            $table->dateTimeTz('expired_at_iso')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::connection(config('iugu.connection'))->table('invoices',function (Blueprint $table) {
            $table->string('captured_at_iso')->nullable()->change();
            $table->string('canceled_at_iso')->nullable()->change();
            $table->string('authorized_at_iso')->nullable()->change();
            $table->string('refunded_at_iso')->nullable()->change();
            $table->dateTime('protested_at_iso')->nullable()->change();
            $table->string('chargeback_at_iso')->nullable()->change();
            $table->string('expired_at_iso')->nullable()->change();
        });
    }

}
