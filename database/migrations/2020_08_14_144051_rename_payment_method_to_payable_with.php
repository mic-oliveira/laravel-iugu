<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenamePaymentMethodToPayableWith extends Migration
{
    public function up()
    {
        Schema::connection(config('iugu.connection'))->table('invoices', function (Blueprint $table) {
            $table->renameColumn('payment_method','payable_with');
        });
    }

    public function down()
    {
        Schema::connection(config('iugu.connection'))->table('invoices',function (Blueprint $table) {
            $table->renameColumn('payable_with','payment_method');
        });
    }

}
