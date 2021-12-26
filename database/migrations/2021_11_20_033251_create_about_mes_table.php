<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAboutMesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('about_mes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('subtitle');
            $table->longText('description');
            $table->string('signature')->nullable();
            $table->string('cv_link')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('experience_year')->default('8');
            $table->string('experience_text')->default('YEARS OF BEST AND SUCCESSFUL WORK EXPERIENCE');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('about_mes');
    }
}
