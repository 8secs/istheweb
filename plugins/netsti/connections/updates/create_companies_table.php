<?php namespace NetSTI\Connections\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateCompaniesTable extends Migration
{

	public function up(){
		Schema::create('netsti_connections_companies', function($table){
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->string('name', 160);
			$table->string('email', 120);
			$table->text('address')->nullable();
            $table->string('city', 60)->nullable();
            $table->string('state', 60)->nullable();
            $table->string('country', 60)->nullable();
            $table->string('phone', 24)->nullable();
		});
	}

	public function down(){
		Schema::dropIfExists('netsti_connections_companies');
	}

}
