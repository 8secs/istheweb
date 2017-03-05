<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 5/03/17
 * Time: 21:06
 */

namespace istheweb\shop\updates;

use Illuminate\Support\Facades\Schema;
use October\Rain\Database\Updates\Migration;

class UpdateOrderItemWithAdjustment extends Migration
{
    public function up()
    {
        Schema::table('istheweb_shop_order_items', function ($table){
            $table->integer('adjustments_total', 11)->nullable();
        });
    }
}