<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameFieldsInvoice extends Migration
{
    public function up()
    {
        Schema::connection(config('iugu.connection'))->table('invoices', function (Blueprint $table) {
            $table->renameColumn('refund_at','refunded_at');
            $table->renameColumn('canceled_atd','canceled_at');
        });
    }

    public function down()
    {
        Schema::connection(config('iugu.connection'))->dropIfExists('invoices');
    }

}
