<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('express', function (Blueprint $table) {
            $table->increments('id')->comment('编号');
            $table->text('express_no')->comment('快递编号');
            $table->string('type',64)->comment('快递类型');
            $table->string('exp_name',64)->comment('快递公司');
            $table->string('exp_site',)->comment("快递公司官网");
            $table->string('exp_phone',64)->comment('快递公司电话');

            $table->unsignedInteger('is_sign')->comment('是否签收');
            $table->json('detail')->comment('物流详情');
            $table->text('courier')->comment('快递员/快递站');
            $table->text('courier_phone')->comment('快递员电话');
            $table->unsignedInteger('delivery_status')->comment("0：快递收件(揽件)1.在途中 2.正在派件 3.已签收 4.派送失败 5.疑难件 6.退件签收  */");
            $table->string('take_time')->comment("发货到收货消耗时长 ");
            $table->dateTime("update_time")->comment("快递更新时间");
            $table->dateTime('created_at')->useCurrent();
            $table
            ->dateTime('updated_at')
            ->nullable()
            ->default(null);
        $table
            ->dateTime('deleted_at')
            ->nullable()
            ->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('express');
    }
}
