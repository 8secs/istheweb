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
            //$table->integer('project_id')->unsigned()->nullable();
            //$table->integer('budget_id')->unsigned()->nullable();
            $table->integer('imageable_id');
            $table->string('imageable_type');
            $table->string('code')->unique();
            $table->string('name')->nullable();
            $table->dateTime('availableOn')->nullable();
            $table->dateTime('availableUntil')->nullable();
            $table->integer('price');
            $table->string('pricing_calculator', 255);
            $table->longText('pricing_configuration')->nullable();

            /*
            $table->integer('on_hold')->nullable();
            $table->integer('on_hand')->nullable();
            $table->tinyInteger('tracked')->default(0);

            $table->double('width')->nullable();
            $table->double('height')->nullable();
            $table->double('depth')->nullable();
            $table->double('weight')->nullable();*/
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('istheweb_iscorporate_variants');
    }
}
