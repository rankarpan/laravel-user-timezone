<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpiryUrlTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expiry_url', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 100);
            $table->string('url', 150);
            $table->string('expires', 15);
            $table->string('signature', 50);
            $table->integer('duration');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('expiry_url');
    }
}
