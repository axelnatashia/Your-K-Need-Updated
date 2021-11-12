<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaylatersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paylaters', function (Blueprint $table) {
            $table->id();
            $table->integer('buyer_id')->unique();
            $table->integer('balance')->nullable();
            $table->string('status');
            $table->string('identity_number');
            $table->string('identity_card_img');
            $table->string('selfie');
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
        Schema::dropIfExists('paylaters');
    }
}
