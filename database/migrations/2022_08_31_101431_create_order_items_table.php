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
            'order_items', function (Blueprint $table) {
                $table->id();
                $table->integer('order_id');                       
                $table->string('item_type')->nullable();   
                $table->integer('item_id')->nullable();   
                $table->integer('qty')->default(1);                     
                $table->float('price');                       
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
        Schema::dropIfExists('order_items');
    }
};
