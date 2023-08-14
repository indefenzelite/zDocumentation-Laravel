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
            'orders', function (Blueprint $table) {
                $table->id();
                $table->integer('user_id');                       
                $table->integer('type_id')->comment('item owner id');                        
                $table->string('type')->comment('role of item owner');                        
                $table->string('txn_no');                       
                $table->float('discount')->nullable()->comment('in number');     
                $table->integer('tax')->nullable()->comment('tax value');   
                $table->json('tax_data')->nullable()->comment('tax in %');   
                $table->integer('shipping')->nullable()->comment('shipping value');    
                $table->float('sub_total');                       
                $table->float('total');                       
                $table->integer('status')->default(0)->comment('1: Idle,2: Packed,3: Shipped,4: Delivered,5: Completed,6: Cancelled,7: Hold');   
                $table->integer('payment_status')->default(0)->comment('1: Unpaid,2: Paid,3: Refund Processing,4: Hold,5: Refunded');  
                $table->string('payment_gateway')->nullable();   
                $table->text('remarks')->nullable();   
                $table->json('payload')->nullable()->comment('Payment Receipt Details');  
                $table->json('from')->nullable()->comment('Seller Info');  
                $table->json('to')->nullable()->comment('Buyer Info'); 
                $table->date('date')->useCurrent();   
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
        Schema::dropIfExists('orders');
    }
};
