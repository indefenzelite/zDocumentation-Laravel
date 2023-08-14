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
        Schema::table('order_items', function (Blueprint $table) {
            $table->integer('tax_percent')->nullable()->comment('items tax_percent')->after('price');
            $table->double('excl_total')->nullable()->comment('price * qty')->after('price');
            $table->double('incl_total')->nullable()->comment('rate * qty')->after('price');
            $table->double('rate',[8,2])->nullable()->comment('incl price')->after('price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_items', function (Blueprint $table) {
            $table->dropColumn('tax_percent');
            $table->dropColumn('excl_total');
            $table->dropColumn('incl_total');
            $table->dropColumn('rate');
        });
    }
};
