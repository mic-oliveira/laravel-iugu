<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameFieldsCharge extends Migration
{
    public function up()
    {
        Schema::connection(config('iugu.connection'))->table('charges', function (Blueprint $table) {
            $table->renameColumn('lr','LR');
        });
    }

    public function down()
    {
        Schema::connection(config('iugu.connection'))->table('charges', function (Blueprint $table) {
            $table->renameColumn('LR','lr');
        });
    }

}
