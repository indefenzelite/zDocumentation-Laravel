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
            'leads', function (Blueprint $table) {
                $table->id();
                $table->integer('user_id');
                $table->text('name');
                $table->integer('lead_type_id');
                $table->integer('lead_source_id');
                $table->string('owner_email')->nullable();
                $table->text('remark')->nullable();
                $table->string('address')->nullable();
                $table->string('phone')->nullable();
                $table->string('website')->nullable();
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
        Schema::dropIfExists('leads');
    }
};
