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
            'blogs', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->string('slug');
                $table->integer('category_id');
                $table->string('description_banner');
                $table->integer('user_id');
                $table->text('description')->nullable();
                $table->string('short_description')->nullable();
                $table->boolean('is_publish')->default(0);
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
        Schema::dropIfExists('blogs');
    }
};
