<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 5/03/17
 * Time: 20:53
 */

namespace istheweb\shop\updates;

use Illuminate\Support\Facades\Schema;
use October\Rain\Database\Updates\Migration;

class UpdateOrderWithAdjustements extends Migration
{
    public function up()
    {
        Schema::table('istheweb_shop_orders', function ($table){
            $table->integer('adjustments_total', 11)->nullable();
            $table->string('state', 255)->nullable();
            $table->string('checkout_state', 255)->nullable();
            $table->string('payment_state', 255)->nullable();
            $table->string('shipping_state', 255)->nullable();
        });
    }
}