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
            'conversations', function (Blueprint $table) {
                $table->dropColumn('enquiry_id');
                $table->string('comment', 50)->nullable()->change();
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
            'conversations', function (Blueprint $table) {
                $table->string('enquiry_id')->default(0);
                $table->string('comment', 50)->nullable(false)->change();
            }
        );
    }
};
