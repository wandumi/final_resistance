<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDmtnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dmtns', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dmtn_section_id');
            $table->string('name');
            $table->string('slug')->nullable()->unique();
            $table->string('pdf');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('dmtn_section_id')->references('id')->on('dmtn_sections');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dmtns');
    }
}
