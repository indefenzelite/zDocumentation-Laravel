<?php
/**
 * Class CartsTable
 *
 * @category ZStarter
 *
 * @ref     zCURD
 * @author  Defenzelite <hq@defenzelite.com>
 * @license https://www.defenzelite.com Defenzelite Private Limited
 * @version <zStarter: 1.1.0>
 * @link    https://www.defenzelite.com
 */
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
 
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'carts', function (Blueprint $table) {
                $table->id();                  
                $table->text('type')->comment('type');                           
                $table->bigInteger('type_id')->comment('type_id');                           
                $table->bigInteger('user_id')->comment('user_id');                             
                $table->integer('qty')->comment('qty')->nullable();                           
                $table->double('price')->comment('price');                             
                $table->double('total')->comment('price')->nullable();                             
                $table->text('remark')->comment('remark')->nullable();                     
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
        Schema::dropIfExists('carts');
    }
}
