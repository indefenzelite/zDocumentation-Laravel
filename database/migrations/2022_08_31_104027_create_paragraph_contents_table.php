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
            'paragraph_contents', function (Blueprint $table) {
                $table->id();
                $table->string('code');                       
                $table->text('value')->nullable();   
                $table->text('type'); 
                $table->text('remark')->nullable();   
                $table->bigInteger('views')->nullable(); 
                $table->text('group');  
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
        Schema::dropIfExists('paragraph_contents');
    }
};
