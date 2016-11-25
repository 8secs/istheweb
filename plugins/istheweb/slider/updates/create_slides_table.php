<?php namespace Istheweb\Slider\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateSlidesTable extends Migration
{

    public function up()
    {
        Schema::create('istheweb_slider_slides', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('slider_id')->unsigned();
            $table->string('name');
            $table->string('slug')->index()->unique();
            $table->text('description')->nullable();
            $table->string('url')->nullable();
            $table->date('published_at')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('istheweb_slider_slides');
    }

}
