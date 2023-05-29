<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFromIdForeignKeyToBalancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_balances', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('from_id')->nullable()->after('user_id');
            $table->foreign('from_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_balances', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('from_id')->nullable()->after('user_id');
            $table->foreign('from_id')->references('id')->on('users');
        });
    }
}
