<?php namespace Istheweb\Carousel\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateSlidesTable extends Migration
{

    public function up()
    {
        Schema::create('istheweb_carousel_slides', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('carousel_id')->unsigned();
            $table->string('name');
            $table->string('transition');
            $table->integer('slotamount');
            $table->integer('masterspeed');
            $table->date('published_at')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('istheweb_carousel_slides');
    }

}
