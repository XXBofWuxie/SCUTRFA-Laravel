<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHealth extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('health', function (Blueprint $table) {
            $table->comment = '挑战杯的数据表';
            $table->increments('id');
            $table->char('data_type', 1)->comment('1是心跳，2是脉搏'); // 1是心跳，2是脉搏
            $table->integer('create_time')->comment('数据创建的时间戳');
            $table->char('data_time', 12)->comment('数据收集的时间');
            $table->text('data')->comment('数据集');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('health');
    }
}
