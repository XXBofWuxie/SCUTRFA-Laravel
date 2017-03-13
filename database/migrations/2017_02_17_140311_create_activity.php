<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateActivity extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity', function (Blueprint $table) {
            $table->comment = '活动表';
            $table->increments('id');
            $table->char('title', 60)->comment('活动标题');
            $table->string('abstract', 150)->comment('活动的简介');
            $table->text('schedule')->comment('活动的时间表，进行php序列化储存');
            $table->string('sign_up_url')->comment('报名的外部链接');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('activity');
    }
}
