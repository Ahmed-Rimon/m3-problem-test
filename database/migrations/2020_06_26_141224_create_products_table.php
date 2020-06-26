<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');

            $table->float('Price');
            $table->mediumText('After_price')->nullable();
            $table->date('task_date');

            $table->string('type')->default('Electric');
            $table->boolean('status')->default(0);
            $table->mediumText('bio')->nullable();
            $table->string('photo')->nullable();
            $table->string('bit-id')->nullable();
            $table->string('win-product')->nullable();
            $table->string('bit-by')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('products');
    }
}
