<?php namespace NetSTI\Connections\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateContactsTable extends Migration
{

	public function up(){
		Schema::create('netsti_connections_contacts', function($table){
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->string('name', 160);
			$table->string('email', 120);
			$table->integer('company_id')->unsigned()->nullable()->index();
			$table->string('phone', 24)->nullable();
		});
	}

	public function down(){
		Schema::dropIfExists('netsti_connections_contacts');
	}

}
