<?php namespace Istheweb\Shop\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('istheweb_shop_products', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('type');
            $table->string('name')->index();
            $table->string('slug')->index()->unique();
            $table->text('caption', 200);
            $table->text('description');
            $table->decimal('price', 10, 2)->default(0)->nullable();
            $table->boolean('on_sale')->default(false);
            $table->float('discount')->nullable();
            $table->date('published_at')->default(Carbon::now());
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('istheweb_shop_products');
    }
}
