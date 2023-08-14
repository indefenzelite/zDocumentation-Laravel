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
            'user_notes', function (Blueprint $table) {
                $table->integer('category_id')->nullable()->comment('categoryId');
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
            'user_notes', function (Blueprint $table) {
                $table->dropColumn('category_id');
            }
        );
    }
};
