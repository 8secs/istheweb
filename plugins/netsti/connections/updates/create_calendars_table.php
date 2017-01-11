<?php namespace NetSTI\Connections\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateCalendarsTable extends Migration
{

	public function up(){
		Schema::create('netsti_connections_calendars', function ($table) {
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->string('name', 160);
			$table->string('color', 18)->nullable();
		});
	}

	public function down(){
		Schema::dropIfExists('netsti_connections_calendars');
	}

}
