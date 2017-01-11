<?php namespace NetSTI\Connections\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class UpdateEventTables extends Migration
{

	public function up(){
		Schema::table('netsti_connections_events', function($table){
			$table->text('description')->nullable();
			$table->string('organizer')->nullable();
			$table->string('address')->nullable();
		});
	}

	public function down(){
		Schema::table('netsti_connections_events', function($table){
			$table->dropColumn('description');
			$table->dropColumn('organizer');
			$table->dropColumn('address');
		});
	}

}
