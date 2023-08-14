<?php
/**
 * Class MyWishlistsTable
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

class CreateMyWishlistsTable extends Migration
{
 
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'my_wishlists', function (Blueprint $table) {
                $table->id();                  
                $table->bigInteger('user_id')->comment('user_id');                           
                $table->text('type')->comment('type');                           
                $table->bigInteger('type_id')->comment('type_id');                             
                $table->json('meta')->comment('meta')->nullable();                     
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
        Schema::dropIfExists('my_wishlists');
    }
}
