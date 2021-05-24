<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FixDatesFieldsInvoice extends Migration
{
    public function up()
    {
        Schema::connection(config('iugu.connection'))->table('invoices', function (Blueprint $table) {
            $table->string('captured_at')->after('paid')->nullable()->change();
            $table->string('authorized_at')->after('captured_at_iso')->nullable()->change();
            $table->string('expired_at')->after('authorized_at_iso')->nullable()->change();
            $table->string('refunded_at')->after('expired_at_iso')->nullable()->change();
            $table->string('canceled_at')->after('refunded_at_iso')->nullable()->change();
            $table->dateTime('protested_at_iso')->after('canceled_at_iso')->nullable()->change();
            $table->string('protested_at')->after('canceled_at_iso')->nullable()->change();
            $table->string('chargeback_at')->after('canceled_at_iso')->nullable()->change();
            $table->date('occurrence_date')->after('chargeback_at_iso')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::connection(config('iugu.connection'))->table('invoices',function (Blueprint $table) {
            $table->string('captured_at')->after('paid')->nullable(false)->change();
            $table->string('authorized_at')->after('captured_at_iso')->nullable(false)->change();
            $table->string('expired_at')->after('authorized_at_iso')->nullable(false)->change();
            $table->string('refunded_at')->after('expired_at_iso')->nullable(false)->change();
            $table->string('canceled_at')->after('refunded_at_iso')->nullable(false)->change();
            $table->dateTime('protested_at_iso')->after('canceled_at_iso')->nullable(false)->change();
            $table->string('protested_at')->after('canceled_at_iso')->nullable(false)->change();
            $table->string('chargeback_at')->after('canceled_at_iso')->nullable(false)->change();
            $table->date('occurrence_date')->after('chargeback_at_iso')->nullable(false)->change();
        });
    }

}
