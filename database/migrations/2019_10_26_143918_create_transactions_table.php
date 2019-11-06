<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            //member
            $table->unsignedInteger('user_id')->nullable();
            $table->foreign('user_id')
                ->on('users')
                ->references('id')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            //product
            $table->unsignedInteger('product_id')->nullable();
            $table->foreign('product_id')
                ->on('products')
                ->references('id')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->integer('qty');
            $table->integer('subtotal');
            //send to 
            $table->string('name');
            $table->json('address');
            $table->string('phone');
            $table->integer('ongkir');
            $table->enum('payment_method',['Cash On Delivery (COD)','Bank Transfer']);
            $table->json('payment_confirm');
            $table->enum('status_pembayaran',['Lunas','Belum Lunas']);
            $table->enum('status_pengiriman',['Belum Dikirim','Sedang Dikirim', 'Telah Diterima']);
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
        Schema::dropIfExists('transactions');
    }
}
