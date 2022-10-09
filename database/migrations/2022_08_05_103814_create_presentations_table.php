<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePresentationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presentations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('presentation_section_id');
            $table->string('name');
            $table->string('slug')->nullable()->unique();
            $table->string("year")->nullable();
            $table->string('upload');
            $table->string('cover_image');
            $table->date('date_of_document')->nullable();
            $table->boolean('archive')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('presentation_section_id')->references('id')->on('presentation_sections');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('presentations');
    }
}
