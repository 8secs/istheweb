<?php namespace Istheweb\Shop\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('istheweb_shop_orders', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('order_status_id')->unsigned();
            $table->integer('customer_id')->unsigned();
            $table->integer('shipping_address_id')->unsigned();
            $table->integer('billing_address_id')->unsigned();
            $table->string('reference', 255)->unique();
            $table->decimal('tax', 15, 2)->nullable();
            $table->decimal('shipping', 15, 2)->nullable();
            $table->decimal('subtotal', 15, 2)->nullable();
            $table->decimal('total', 15, 2)->nullable();
            $table->string('currency_code', 3)->nullable();
            $table->string('locale_code', 255)->nullable();
            $table->string('customer_ip', 255)->nullable();
            $table->string('comments', 1000)->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('istheweb_shop_orders');
    }
}
