<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogoPropertyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logo_property', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('logo_id');
            $table->unsignedBigInteger('property_id');
            $table->string('tenants')->nullable();
            $table->timestamps();

            $table->foreign('logo_id')->references('id')->on('logos')->onDelete('cascade');
            $table->foreign('property_id')->references('id')->on('properties')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('logo_property');
    }
}
