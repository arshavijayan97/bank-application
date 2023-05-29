<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserBalancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_balances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->decimal('amount', 8, 2)->default(0);
            $table->string('type')->comment('Transaction type: deposit, withdrawal,transfer');
            $table->decimal('balance', 8, 2)->default(0);
            $table->string('tranfer_type')->comment('Transaction type: credit or debit')->nullable();
            $table->timestamp('date')->useCurrent();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_balances');
    }
}
