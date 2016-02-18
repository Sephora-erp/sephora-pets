<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class pet extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pet', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('fk_client')->unsigned();
            $table->integer('fk_user')->unsigned();
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('type');
            $table->longText('observations')->nullable();
            $table->string('birthdate');
            //Timestamps
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
