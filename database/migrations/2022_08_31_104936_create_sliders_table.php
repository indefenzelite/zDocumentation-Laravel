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
            'sliders', function (Blueprint $table) {
                $table->id();
                $table->string('title');                       
                $table->string('image');                       
                $table->boolean('status')->default(1);   
                $table->integer('slider_type_id');                       
                $table->integer('type')->default(0)->comment('0=>Plain Text, 1=> Rich Text, 2=> Webpage Link, 3=> Image Link, 4=> Document Link');                       
                $table->text('description')->nullable();   
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
        Schema::dropIfExists('sliders');
    }
};
