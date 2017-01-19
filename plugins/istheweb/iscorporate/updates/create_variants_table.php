<?php namespace Istheweb\IsCorporate\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateVariantsTable extends Migration
{
    public function up()
    {
        Schema::create('istheweb_iscorporate_variants', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('employee_id')->unsigned();
            $table->integer('imageable_id');
            $table->string('imageable_type');
            $table->string('code')->unique();
            $table->string('name')->nullable();
            $table->dateTime('availableOn')->nullable();
            $table->dateTime('availableUntil')->nullable();
            $table->integer('plazo');
            $table->integer('horas');
            $table->longText('data')->nullable();
            $table->longText('urls')->nullable();
            //$table->longText('reports')->nullable();
            $table->integer('price');
            $table->integer('status')->default(1);
            $table->string('pricing_calculator', 255);
            $table->longText('pricing_configuration')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('istheweb_iscorporate_variants');
    }
}
