<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 8/08/16
 * Time: 20:54
 */

namespace Istheweb\Shop\Updates;

use Carbon\Carbon;
use Schema;
use October\Rain\Database\Updates\Migration;


class UpdateProductsTable extends Migration
{
    public function up()
    {
        Schema::table('istheweb_shop_products', function ($table) {
            $table->date('published_at')->default(Carbon::now());
        });
    }
}