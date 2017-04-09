<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateArchivesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create(config('siravel.db-prefix', '').'archives', function (Blueprint $table) {
            $table->increments('id');
            $table->string('token');
            $table->integer('entity_id');
            $table->string('entity_type');
            $table->text('entity_data');
            $table->nullableTimestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop(config('siravel.db-prefix', '').'archives');
    }
}
