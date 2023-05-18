<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('diaristas', function (Blueprint $table) {
            $table->id();
            $table->string('nome_completo', 100);
            $table->char('cpf');
            $table->string('email', 100);
            $table->char('telefone');
            $table->string('logradouro');
            $table->string('numero', 20);
            $table->string('bairro', 50);
            $table->string('cidade', 50);
            $table->string('complemento', 50)->nullable();
            $table->char('cep');
            $table->char('estado', 2);
            $table->integer('codigo_ibge');
            $table->string('foto_usuario');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diaristas');
    }
};
