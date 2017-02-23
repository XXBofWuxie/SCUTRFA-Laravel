<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateForilegium extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forilegium', function (Blueprint $table) {
            $table->comment = '作品集锦';
            $table->increments('id');
            $table->char('title', 60)->comment('标题');
            $table->string('abstract', 150)->comment('简介');
            $table->integer('creata_time')->comment('创建时间戳');
            $table->integer('update_time')->comment('更新时间戳');
            $table->string('surface_plot_url')->comment('标题图文件地址');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('forilegium');
    }
}
