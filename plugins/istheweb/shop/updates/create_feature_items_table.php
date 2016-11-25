<?php namespace Istheweb\Shop\Updates;

use Carbon\Carbon;
use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateFeatureItemsTable extends Migration
{
    public function up()
    {
        Schema::create('istheweb_shop_feature_items', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('feature_id')->unsigned();
            $table->string('name')->nullable();
            $table->string('value')->nullable();
            $table->date('published_at')->default(Carbon::now());
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('istheweb_shop_feature_items');
    }
}
