<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 1/06/16
 * Time: 20:48
 */

namespace Istheweb\Carousel\Updates;



use Illuminate\Support\Facades\Schema;
use October\Rain\Database\Updates\Migration;

class UpdateItemsTable extends Migration
{
    public function up()
    {
        Schema::table('istheweb_carousel_items', function ($table) {

            //$table->string('icon')->nullable();
            $table->string('cssClass')->nullable();
        });
    }

}