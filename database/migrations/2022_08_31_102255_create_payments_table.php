<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'payments', function (Blueprint $table) {
                $table->id();
                $table->string('r_payment_id');
                $table->string('order_id');
                $table->string('user_id');
                $table->string('amount');
                $table->integer('status')->defaultValue(0)->comment('0:pending, 1:success, 2:failed	');
                $table->timestamps();
                $table->softDeletes();
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
};
