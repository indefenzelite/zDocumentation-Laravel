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
        Schema::table(
            'wallet_logs', function (Blueprint $table) {
                $table->integer('revert_by')->nullable()->comment('auth()->id()');
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
        Schema::table(
            'wallet_logs', function (Blueprint $table) {
                $table->dropColumn('revert_by');
            }
        );
    }
};
