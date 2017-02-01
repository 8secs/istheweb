<?php namespace Istheweb\Shop\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateOrderItemsTable extends Migration
{
    public function up()
    {
        Schema::create('istheweb_shop_order_items', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('order_id')->unsigned();
            $table->integer('variant_id')->unsigned();
            $table->integer('quantity');
            $table->decimal('unit_price', 13, 2);
            $table->decimal('unit_total', 13, 2);
            $table->decimal('total', 13, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('istheweb_shop_order_items');
    }
}