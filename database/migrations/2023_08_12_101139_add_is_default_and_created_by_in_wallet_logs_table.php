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
        Schema::table('wallet_logs', function (Blueprint $table) {
           $table->boolean('is_default')->default(0)->after('status')->comment('0:system generated, 1:admin or user action performed');
           $table->unsignedBigInteger('created_by')->nullable()->after('status')->comment('if not system generated then auth id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('wallet_logs', function (Blueprint $table) {
            $table->dropColumn('is_default');
            $table->dropColumn('created_by');
        });
    }
};
