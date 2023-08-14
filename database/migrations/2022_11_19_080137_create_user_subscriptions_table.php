<?php
/**
 * Class UserSubscriptionsTable
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

class CreateUserSubscriptionsTable extends Migration
{
 
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'user_subscriptions', function (Blueprint $table) {
                $table->id();                  
                $table->bigInteger('user_id')->comment('user_id');                           
                $table->bigInteger('subscription_id')->comment('subscription_id');                                   
                $table->date('from_date')->useCurrent()->comment('from_date');                                      
                $table->date('to_date')->comment('to_date');                             
                $table->bigInteger('parent_id')->comment('parent_id')->nullable();                     
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
        Schema::dropIfExists('user_subscriptions');
    }
}
