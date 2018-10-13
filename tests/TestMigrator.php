<?php

use Illuminate\Database\Capsule\Manager as DB;

class TestMigrator
{
    public function up()
    {
        DB::schema()->dropIfExists('tests');
        DB::schema()->create('tests', function ($table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('title');
            $table->text('body');
        });
    }
    public function down()
    {
        DB::schema()->drop('tests');
    }
}