<?php namespace NetSTI\Connections\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateEventsTable extends Migration
{

	public function up(){
		Schema::create('netsti_connections_events', function ($table) {
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->string('name', 80);
			$table->integer('calendar_id')->unsigned()->nullable()->index();
			$table->datetime('start_date');
			$table->datetime('end_date');
		});
	}

	public function down(){
		Schema::dropIfExists('netsti_connections_events');
	}

}
