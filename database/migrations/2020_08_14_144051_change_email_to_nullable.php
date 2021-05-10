<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeEmailToNullable extends Migration
{
    public function up()
    {
        Schema::connection(config('iugu.connection'))->table('invoices', function (Blueprint $table) {
            $table->string('email')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::connection(config('iugu.connection'))->table('invoices',function (Blueprint $table) {
            $table->string('email')->nullable(false)->change();
        });
    }

}
