<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 1/02/17
 * Time: 17:25
 */

namespace istheweb\shop\updates;


use Illuminate\Support\Facades\Schema;
use October\Rain\Database\Updates\Migration;

class UpdateProductTable extends Migration
{
    public function up()
    {
        Schema::table('istheweb_shop_products', function ($table){
            $table->integer('tax_category_id')->unsigned()->nullable();
            $table->integer('shipping_category_id')->unsigned()->nullable();
            $table->double('width')->nullable();
            $table->double('height')->nullable();
            $table->double('depth')->nullable();
            $table->double('weight')->nullable();
        });
    }

}