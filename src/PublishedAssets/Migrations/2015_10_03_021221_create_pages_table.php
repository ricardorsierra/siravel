<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create(config('siravel.db-prefix', '').'pages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('url');
            $table->text('entry')->nullable();
            $table->string('seo_description')->nullable();
            $table->string('seo_keywords')->nullable();
            $table->boolean('is_published')->default(0);
            $table->nullableTimestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop(config('siravel.db-prefix', '').'pages');
    }
}
