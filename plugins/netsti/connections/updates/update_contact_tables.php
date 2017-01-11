<?php namespace NetSTI\Connections\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class UpdateContactTables extends Migration
{

	public function up(){
		Schema::table('netsti_connections_contacts', function($table){
            $table->string('position', 60)->nullable();
			$table->text('address')->nullable();
            $table->string('city', 60)->nullable();
            $table->string('state', 60)->nullable();
            $table->string('country', 60)->nullable();
            $table->string('zip_code')->nullable();

            $table->string('sn_facebook', 60)->nullable();
            $table->string('sn_twitter', 60)->nullable();
            $table->string('sn_linkedin', 60)->nullable();
            $table->string('sn_gplus', 60)->nullable();
		});

		Schema::table('netsti_connections_companies', function($table){
			$table->string('zip_code')->nullable();

			$table->string('sn_facebook', 60)->nullable();
            $table->string('sn_twitter', 60)->nullable();
            $table->string('sn_linkedin', 60)->nullable();
            $table->string('sn_gplus', 60)->nullable();
		});
	}

	public function down(){
		Schema::table('netsti_connections_contacts', function($table){
			$table->dropColumn('position');
			$table->dropColumn('address');
            $table->dropColumn('city');
            $table->dropColumn('state');
            $table->dropColumn('country');
            $table->dropColumn('zip_code');

            $table->dropColumn('sn_facebook');
            $table->dropColumn('sn_twitter');
            $table->dropColumn('sn_linkedin');
            $table->dropColumn('sn_gplus');
		});

		Schema::table('netsti_connections_companies', function($table){
			$table->dropColumn('zip_code');

            $table->dropColumn('sn_facebook');
            $table->dropColumn('sn_twitter');
            $table->dropColumn('sn_linkedin');
            $table->dropColumn('sn_gplus');
		});
	}

}