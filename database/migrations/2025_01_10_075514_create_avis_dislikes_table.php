<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAvisDislikesTable extends Migration
{
    public function up()
    {
        Schema::create('avis_dislikes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('avis_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('avis_id')->references('id')->on('avis_commentaires')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('avis_dislikes');
    }
}
