<?php namespace Istheweb\Corporate\Updates;

use October\Rain\Database\Updates\Migration;
use Schema;

class CreatePivotsTable extends Migration
{

    public $models = [
        'employee',
        'gallery',
        'project',
        'project_category',
        'role',
        'service',
        'technology',
        'testimonial',
    ];

    public function up()
    {
        Schema::create('istheweb_corporate_pivots', function ($table) {
            $table->engine = 'InnoDB';
            foreach ($this->models as $model) {
                $table->integer($model . '_id')->unsigned()->nullable()->index();
            }
        });
    }

    public function down()
    {
        Schema::dropIfExists('istheweb_corporate_pivots');
    }

}