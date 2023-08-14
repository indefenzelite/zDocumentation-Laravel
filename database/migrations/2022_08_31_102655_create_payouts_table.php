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
            'payouts', function (Blueprint $table) {
                $table->id();
                $table->integer('user_id')->comment('belongs to user table');                       
                $table->double('amount')->comment('requested amount');                       
                $table->integer('type')->comment('0: bank,1: upi');                       
                $table->integer('status')->comment('0:unpaid,1:paid,2:cancel');                       
                $table->json('bank_details')->nullable();                       
                $table->json('user_details')->nullable();                       
                $table->string('txn_no')->nullable();                       
                $table->text('remark')->nullable();                       
                $table->integer('approved_by')->comment('whom approved this request');                       
                $table->dateTime('approved_at')->comment('when approved this request');                       
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
        Schema::dropIfExists('payouts');
    }
};
