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
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('tax');
            $table->dropColumn('tax_data');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
           $table->double('tax',8,2)->after('discount')->nullable()->comment('tax value');
           $table->json('tax_data')->after('discount')->nullable()->comment('tax data in %');
        });
    }
};
