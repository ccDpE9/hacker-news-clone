<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserToLinks extends Migration
{
    public function up()
    {
        Schema::table('links', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
        });
    }

    public function down()
    {
        Schema::table('links', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });
    }
}
