<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pronvice_id');
            $table->string('name');
            $table->string('slug')->nullable()->unique();
            $table->text('description');
            $table->string('website_link');
            $table->string('cover_image');
            $table->string('banner_image');
            $table->integer('featured')->nullable();
            $table->string('pro_rata_interest')->nullable();
            $table->string('vacancy')->nullable();
            $table->string('gla')->nullable();
            $table->integer('list')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('pronvice_id')->references('id')->on('pronvices');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('properties');
    }
}
