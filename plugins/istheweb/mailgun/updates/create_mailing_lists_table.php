<?php namespace Istheweb\Mailgun\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateMailingListsTable extends Migration
{
    public function up()
    {
        Schema::create('istheweb_mailgun_mailing_lists', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('istheweb_mailgun_mailing_lists');
    }
}
