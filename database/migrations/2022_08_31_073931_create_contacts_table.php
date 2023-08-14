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
            'contacts', function (Blueprint $table) {
                $table->id();
                $table->text('first_name');
                $table->text('last_name');
                $table->string('email');
                $table->string('phone');
                $table->string('job_title')->nullable();
                $table->string('gender')->nullable();
                $table->string('type')->nullable();
                $table->string('type_id')->nullable();
                $table->text('address')->nullable();
                $table->timestamps();
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
        Schema::dropIfExists('contacts');
    }
};
