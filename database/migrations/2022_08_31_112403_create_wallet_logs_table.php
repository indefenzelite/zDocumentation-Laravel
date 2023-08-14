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
            'wallet_logs', function (Blueprint $table) {
                $table->id();
                $table->integer('user_id');
                $table->text('type');
                $table->double('amount');
                $table->text('remark');
                $table->integer('status')->default(0);
                $table->double('after_balance')->nullable();
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
        Schema::dropIfExists('wallet_logs');
    }
};
