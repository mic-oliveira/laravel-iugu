<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePixJsonField extends Migration
{
    public function up()
    {
        Schema::connection(config('iugu.connection'))->table('invoices', function (Blueprint $table) {
            $table->json('pix')->nullable()->after('payable_with');
        });
    }

    public function down()
    {
        Schema::connection(config('iugu.connection'))->table('invoices',function (Blueprint $table) {
            $table->dropColumn('pix');
        });
    }

}
