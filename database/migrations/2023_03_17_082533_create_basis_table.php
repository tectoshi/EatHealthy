<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('basis', function (Blueprint $table) {
            $table->increments('id')->unsigned()->comment('id');
            $table->char('name',255)->comment('食材名');
            $table->float('calorie')->comment('カロリー');
            $table->float('carbohydrates')->comment('炭水化物');
            $table->float('protein')->comment('タンパク質');
            $table->float('lipid')->comment('脂質');
            $table->float('sugar')->comment('糖質');
            $table->float('fiber')->comment('食物繊維');
            $table->float('input_unit')->comment('1個当たりのグラム');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('basis');
    }
}
