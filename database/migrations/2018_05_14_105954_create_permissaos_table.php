<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissoes', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('permissao',['N','R','RE','RED']);

            /*Ca - Categoria
            * Pr - Produtos
            * Cl - Cliente
            * Fu - Funcionario
            * Pe - Permissões
            * Ve - Vendendor
            * Em - Empresa
            */

            $table->enum('navegacao',['ca','pr','cl','fu','pe','ve','em']);
            $table->unsignedInteger('user_id');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('tipo_users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permissoes');
    }
}
