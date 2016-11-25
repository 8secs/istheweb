<?php namespace Istheweb\Corporate\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateTestimonialsTable extends Migration
{

    public function up()
    {
        Schema::create('istheweb_corporate_testimonials', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('content');
            $table->string('source');
            $table->string('url');
            $table->date('published_at')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('istheweb_corporate_testimonials');
    }

}
