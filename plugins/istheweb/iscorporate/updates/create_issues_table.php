<?php namespace Istheweb\IsCorporate\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateIssuesTable extends Migration
{
    public function up()
    {
        Schema::create('istheweb_iscorporate_issues', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name_contact', 255)->nullable();
            $table->string('surname_contact', 255)->nullable();
            $table->string('subject', 600)->nullable();
            $table->text('description')->nullable();
            $table->tinyInteger('state')->default(0);
            $table->date('published_at')->default(Carbon::now());
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('istheweb_iscorporate_issues');
    }
}
