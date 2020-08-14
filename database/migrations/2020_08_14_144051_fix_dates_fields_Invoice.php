<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FixDatesFieldsInvoice extends Migration
{
    public function up()
    {
        Schema::connection(config('iugu.connection'))->table('invoices', function (Blueprint $table) {
            $table->string('captured_at')->after('paid')->nullable();
            $table->string('authorized_at')->after('captured_at_iso')->nullable();
            $table->string('expired_at')->after('authorized_at_iso')->nullable();
            $table->string('refunded_at')->after('expired_at_iso')->nullable();
            $table->string('canceled_at')->after('refunded_at_iso')->nullable();
            $table->string('protested_at')->after('canceled_at_iso')->nullable();
            $table->dateTime('protested_at_iso')->after('protested_at')->nullable();
            $table->string('chargeback_at')->after('protested_at_iso')->nullable();
            $table->date('occurrence_date')->after('chargeback_at_iso')->nullable();
        });
    }

    public function down()
    {
        Schema::connection(config('iugu.connection'))->table('invoices',function (Blueprint $table) {
            $table->dropColumn('authorized_at');
            $table->dropColumn('expired_at');
            $table->dropColumn('refunded_at');
            $table->dropColumn('canceled_at');
            $table->dropColumn('protested_at');
            $table->dropColumn('chargeback_at');
            $table->dropColumn('ocurrence_date');
        });
    }

}
