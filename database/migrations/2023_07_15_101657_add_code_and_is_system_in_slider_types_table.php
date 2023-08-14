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
        Schema::table('slider_types', function (Blueprint $table) {
            $table->string('code')->nullable()->after('title')->nullable();
            $table->boolean('is_published')->default(0)->after('title')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('slider_types', function (Blueprint $table) {
            $table->dropColumn('code');
            $table->dropColumn('is_published');
        });
    }
};
