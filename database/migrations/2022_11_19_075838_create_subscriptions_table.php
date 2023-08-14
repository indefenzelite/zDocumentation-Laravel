<?php
/**
 * Class SubscriptionsTable
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

class CreateSubscriptionsTable extends Migration
{
 
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'subscriptions', function (Blueprint $table) {
                $table->id();                  
                $table->string('name')->comment('name');                           
                $table->text('duration')->comment('duration');                           
                $table->double('price')->comment('price');                                   
                $table->boolean('is_published')->default(1)->comment('is_published');                               
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
        Schema::dropIfExists('subscriptions');
    }
}
