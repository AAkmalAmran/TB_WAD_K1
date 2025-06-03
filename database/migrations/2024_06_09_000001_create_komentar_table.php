<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKomentarTable extends Migration
{
    public function up()
    {
        Schema::create('komentar', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('berita_id');
            $table->unsignedBigInteger('user_id');
            $table->text('isi');
            $table->timestamps();

            $table->foreign('berita_id')->references('id')->on('berita')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('komentar');
    }
}
