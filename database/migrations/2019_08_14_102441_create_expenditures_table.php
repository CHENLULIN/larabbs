<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpendituresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenditures', function (Blueprint $table) {
        	$table->bigIncrements('id');
            $table->bigInteger('user_id')->nullable(false)->default(0)->comment('用户id');
            $table->string('title','255')->nullable(false)->default('')->comment('标题');
            $table->string('description', '255')->nullable(false)->default('')->comment('简介');
            $table->string('address', '255')->nullable(false)->default('')->comment('消费地址');
            $table->timestamp('expenditure_time')->comment('消费时间');
            $table->decimal('expenditure_money', 20, 2)->comment('消费金额');
            $table->string('pic', 255)->nullable(false)->default('')->comment('图片地址');
            $table->tinyInteger('pay_type')->nullable(false)->default(1)->comment('支付方式1：支付宝，2：微信，3：现金，4：刷卡');
            $table->string('cart', 255)->nullable(false)->default('')->comment('卡号尾号');
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
	    Schema::dropIfExists('expenditures');
    }
}
