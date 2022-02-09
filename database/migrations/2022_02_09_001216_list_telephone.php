<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ListTelephone extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('list_telephone', function (Blueprint $table) {
            $table->id();
            $table->foreignId("id_tele_provider");
            $table->string("phone", 20);
            $table->boolean("is_odd")->default(true);
            $table->timestamps();

            $table->foreign("id_tele_provider")->references("id")->on("tele_provider");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('list_telephone');
    }
}
