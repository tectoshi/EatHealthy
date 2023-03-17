<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNutrientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nutrients', function (Blueprint $table) {
            $table->increments('id')->unsigned()->comment('id');
            $table->char('name',255)->comment('食材名');
            $table->float('calorie', 8, 2)->comment('カロリー');
            $table->float('carbohydrates', 8, 2)->comment('炭水化物');
            $table->float('protein', 8, 2)->comment('タンパク質');
            $table->float('lipid', 8, 2)->comment('脂質');
            $table->float('sugar', 8, 2)->comment('糖質');
            $table->float('fiber', 8, 2)->comment('食物繊維');
            $table->integer('number', 255)->comment('購入個数');
            $table->data('date')->comment('登録日');
            $table->integer('user_id')->unsigned(); // 符号無し属性に変更
            $table->foreign('user_id')->references('id')->on('users')
                    ->onDelete('cascade')->comment('ユーザーid'); // 外部キー参照
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nutrients');
    }
}
