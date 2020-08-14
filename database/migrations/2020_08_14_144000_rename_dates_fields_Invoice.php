<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameDatesFieldsInvoice extends Migration
{
    public function up()
    {
        Schema::connection(config('iugu.connection'))->table('invoices', function (Blueprint $table) {
            $table->renameColumn('captured_at','captured_at_iso');
            $table->renameColumn('authorized_at','authorized_at_iso');
            $table->renameColumn('expired_at','expired_at_iso');
            $table->renameColumn('refunded_at','refunded_at_iso');
            $table->renameColumn('canceled_at','canceled_at_iso');
            $table->renameColumn('chargeback_at','chargeback_at_iso');
        });
    }

    public function down()
    {
        Schema::connection(config('iugu.connection'))->table('invoices',function (Blueprint $table) {
            $table->renameColumn('captured_at_iso','captured_at');
            $table->renameColumn('authorized_at_iso','authorized_at');
            $table->renameColumn('expired_at_iso','expired_at');
            $table->renameColumn('refunded_at_iso','refunded_at');
            $table->renameColumn('canceled_at_iso','canceled_at');
            $table->renameColumn('chargeback_at_iso','chargeback_at');
        });
    }

}
