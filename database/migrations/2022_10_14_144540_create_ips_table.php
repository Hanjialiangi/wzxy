<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ips', function (Blueprint $table) {
            $table->id();
            $table->string('ip',32)->comment("ip区段");
            $table->string('long_ip')->comment("long类型的ip地址");
            $table->string('country')->commnet('国家');
            $table->string('country_id')->commnet('国家编号');
            $table->string('province')->commnet('省份');
            $table->string('province_id')->commnet('省份编号');
            $table->string('city')->commnet('城市');
            $table->string('city_id')->commnet('城市编号');
            $table->string('area')->comment('地区');
            $table->string('isp')->comment('运营商');
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
        Schema::dropIfExists('ips');
    }
}
