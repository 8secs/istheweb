<?php namespace Istheweb\Slider\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateSlidersTable extends Migration
{

    public function up()
    {
        Schema::create('istheweb_slider_sliders', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->text('description');
            $table->date('published_at')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('istheweb_slider_sliders');
    }

}
