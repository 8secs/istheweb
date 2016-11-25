<?php namespace Istheweb\Faq\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateCategoriesTable extends Migration
{

    public function up()
    {
        Schema::create('istheweb_faq_categories', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->longText('title');
            $table->string('lang')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('istheweb_faq_categories');
    }

}
