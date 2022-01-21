<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_menu', function (Blueprint $table) {
            $table->increments('id_menu')->nullable(false);
            $table->string('kd_menu',6)->unique();
            $table->string('nm_menu',100);
            $table->integer('harga');
            $table->enum('kategori',['Makanan','Minuman','Snack']);
            $table->string('satuan',10);
            $table->enum('stok',['Available','Not Available']);
            $table->text('ket')->nullable(true);
            $table->longText('foto')->nullable(true);
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
        Schema::dropIfExists('tb_menu');
    }
}
