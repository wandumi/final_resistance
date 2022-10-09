<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePortifoliosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('portifolios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('properties_id');
            $table->string('slug')->nullable()->unique();
            $table->integer('numberOfShared');
            $table->integer('perOfIssueShares');
            $table->string('cover_image');
            $table->softDeletes();
            $table->timestamps();

    
            $table->foreign('properties_id')->references('id')->on('properties');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('portifolios');
    }
}
