<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PetReviews extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('pet_reviews', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->longText('note')->nullable();
            $table->integer('done');
            $table->timestamp('date_revision');
            //Not really a fk
            $table->integer('fk_pet')->unsigned();
            $table->integer('fk_client')->unsigned();
            //Fk's
            $table->foreign('fk_pet')->references('id')->on('pet');
            $table->foreign('fk_client')->references('id')->on('customers');
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
    public function down() {
        //
    }

}
