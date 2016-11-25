<?php namespace Istheweb\Corporate\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateRolesTable extends Migration
{

    public function up()
    {
        Schema::create('istheweb_corporate_roles', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->string('description');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('istheweb_corporate_roles');
    }

}
