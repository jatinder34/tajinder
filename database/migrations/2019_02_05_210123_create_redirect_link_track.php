<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRedirectLinkTrack extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('redirect_link_track', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ip')->nullable();
            $table->integer('click_count')->default(0);
            $table->string('type')->nullable()->default(0);
            $table->integer('linkid')->nullable();
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
        Schema::dropIfExists('redirect_link_track');
    }
}
