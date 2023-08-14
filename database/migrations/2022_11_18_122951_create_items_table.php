<?php
/**
 * Class ItemsTable
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

class CreateItemsTable extends Migration
{
 
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'items', function (Blueprint $table) {
                $table->id();                  
                $table->bigInteger('user_id')->nullable();                           
                $table->string('name')->comment('name');                           
                $table->bigInteger('category_id')->comment('category_id');                           
                $table->double('sell_price')->comment('');                           
                $table->double('mrp_price')->comment('mrp_price');                          
                $table->enum('status', ["Available","Notavailable"])->comment('"Available","Notavailable"');                          
                $table->longText('short_description')->comment('short_description')->nullable();                             
                $table->longText('description')->comment('description')->nullable();                           
                $table->string('slug')->comment('slug')->unique();                              
                $table->json('meta')->comment('meta')->nullable();                               
                $table->boolean('is_featured')->default(1)->comment('is_featured')->nullable();                                             
                $table->boolean('is_published')->default(1)->comment('is_published');                                       
                $table->text('sku')->comment('sku')->nullable();                             
                $table->tinyInteger('tax_percent')->comment('tax_percent')->nullable();                     
                $table->bigInteger('views')->comment('on each time view inc count')->nullable();                     
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
        Schema::dropIfExists('items');
    }
}
