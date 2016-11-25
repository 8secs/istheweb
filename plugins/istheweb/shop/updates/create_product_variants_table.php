<?php namespace Istheweb\Shop\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateProductVariantsTable extends Migration
{
    public function up()
    {
        Schema::create('istheweb_shop_product_variants', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('product_id')->unsigned();
            $table->string('name')->index();
            $table->text('caption', 200);
            $table->text('description');
            $table->decimal('price', 10, 2)->default(0)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('istheweb_shop_product_variants');
    }
}
