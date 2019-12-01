<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class CreateSharesTable extends Migration{
    public function up()
    {
        Schema::create('shares', function (Blueprint $table) {
             $table->bigIncrements('id');
             $table->string('user_id');             
             $table->string('post_id');
             $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('shares');
    }
}
