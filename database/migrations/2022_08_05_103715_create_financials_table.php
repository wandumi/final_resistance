<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinancialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('financials', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('financial_section_id');
            $table->string('name');
            $table->string('slug')->nullable()->unique();
            $table->string('year')->nullable();
            $table->string('pdf');
            $table->string('cover_image');
            $table->date('date_of_document')->nullable();
            $table->boolean('archive')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('financial_section_id')->references('id')->on('financial_sections');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('financials');
    }
}
