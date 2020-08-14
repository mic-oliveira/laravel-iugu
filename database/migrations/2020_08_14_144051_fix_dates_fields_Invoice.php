<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameFieldsCharge extends Migration
{
    public function up()
    {
        Schema::connection(config('iugu.connection'))->table('charges', function (Blueprint $table) {
            $table->renameColumn('captured_at','captured_at_iso');
            $table->renameColumn('authorized_at','authorized_at_iso');
            $table->renameColumn('expired_at','expired_at_iso');
            $table->renameColumn('refunded_at','refunded_at_iso');
            $table->renameColumn('canceled_at','canceled_at_iso');
            $table->renameColumn('chargeback_at','chargeback_at_iso');
            $table->string('captured_at')->after('paid')->nullable();
            $table->string('authorized_at')->after('captured_at_iso')->nullable();
            $table->string('expired_at')->after('authorized_at_iso')->nullable();
            $table->string('refunded_at')->after('expired_at_iso')->nullable();
            $table->string('canceled_at')->after('refunded_at_iso')->nullable();
            $table->string('protested_at')->nullable();
            $table->dateTime('protested_at_iso')->nullable();
            $table->string('chargeback_at')->after('protested_at_iso')->nullable();
            $table->date('occurrence_date')->after('chargeback_at_iso')->nullable();
        });
    }

    public function down()
    {
        Schema::connection(config('iugu.connection'))->table('charges',function (Blueprint $table) {
            $table->dropColumn('authorized_at');
            $table->dropColumn('expired_at');
            $table->dropColumn('refunded_at');
            $table->dropColumn('canceled_at');
            $table->dropColumn('protested_at');
            $table->dropColumn('chargeback_at');
            $table->dropColumn('ocurrence_date');
            $table->renameColumn('captured_at_iso','captured_at');
            $table->renameColumn('authorized_at_iso','authorized_at');
            $table->renameColumn('expired_at_iso','expired_at');
            $table->renameColumn('refunded_at_iso','refunded_at');
            $table->renameColumn('canceled_at_iso','canceled_at');
            $table->renameColumn('protested_at_iso','protested_at');
            $table->renameColumn('chargeback_at_iso','chargeback_at');
        });
    }

}
