<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_produto')->nullable();
            $table->unsignedBigInteger('id_cliente')->nullable();
            $table->date('data_venda');
            $table->integer('quantidade_produto');
            $table->float('desconto');

            $table->char('status_venda', 1)
            ->comment('v: Vendidos, c: Cancelados, d: Devoluções');

            $table->foreign('id_produto', 'vendas_id_produto_foreign')
            ->references('id')->on('produtos')
            ->onUpdate('CASCADE');

            $table->foreign('id_cliente', 'vendas_id_cliente_foreign')
            ->references('id')->on('clientes')
            ->onUpdate('CASCADE');

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
        Schema::dropIfExists('vendas');
    }
}
