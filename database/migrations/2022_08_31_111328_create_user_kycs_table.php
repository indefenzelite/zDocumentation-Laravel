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
            'user_kycs', function (Blueprint $table) {
                $table->id();
                $table->bigInteger('user_id')->comment('belongs to user table');                       
                $table->integer('status')->comment('0=&gt;pending,1=&gt;accepted,2=&gt;rejected');                       
                $table->longText('details')->nullable();                       
                $table->text('type')->nullable();                       
                $table->string('number')->nullable();                       
                $table->string('front_image')->nullable();                       
                $table->string('back_image')->nullable();                       
                $table->string('face_with_doc')->nullable();                       
                $table->string('legal_name')->nullable();                       
                $table->longText('remark')->nullable();                       
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
        Schema::dropIfExists('user_kycs');
    }
};
