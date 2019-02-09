<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLinkFilterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('link_filter', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('link_id');
            $table->integer('type')->default(0)->comment('1 for IP,2 for ISP,3 for Browser,4 for OS,5 for Device Type,6 for Countries');
            $table->string('parameter')->nullable();
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
        Schema::dropIfExists('link_filter');
    }
}
